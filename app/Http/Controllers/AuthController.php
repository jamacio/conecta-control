<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification as MailEmailVerification;
use App\Mail\PasswordResetEmail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('front.account.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('account.login.index');
    }

    public function registration()
    {
        return view('front.account.registration');
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $message = 'Usuário registrado com sucesso!';
            return redirect()
                ->route('account.login.index')
                ->with('success', $message);
        } else {
            return redirect()
                ->route('account.registration.index')
                ->with('error', $validator->errors()->first());
        }
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $userCredential = $request->only('email', 'password');
        $userData = User::where('email', $request->email)->first();

        if (Auth::attempt($userCredential)) {
            return redirect()->route('account.profile.show');
        } else {
            return redirect()
                ->route('account.login.index')
                ->with('error', 'E-mail ou senha inválidos!');
        }

        if ($userData && $userData->is_verified == 0) {
            $this->sendOtp($userData);

            return redirect()
                ->route('account.verification', $userData->id)
                ->with('error', 'Por favor, verifique seu endereço de e-mail!');
        } else if ($validator->passes()) {
            if (Auth::attempt($userCredential)) {
                return redirect()->route('account.profile.show');
            } else {
                return redirect()
                    ->route('account.login.index')
                    ->with('error', 'E-mail ou senha inválidos!');
            }
        } else {
            return redirect()
                ->route('account.login.index')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        if (Hash::check($request->old_password, Auth::user()->password) == false) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'old_password' => ['A senha antiga não corresponde!'],
                ],
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->new_password);
        $user->save();

        $message = 'Senha atualizada com sucesso!';
        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function forgotPassword()
    {
        return view('front.account.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('account.forgot.password')
                ->withInput($request->only('email'))
                ->withErrors($validator);
        }

        $generatedPasswordResetToken = Str::random(50);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $generatedPasswordResetToken,
            'created_at' => now(),
        ]);

        $user = User::where('email', $request->email)->first();
        $actionUrl = env('APP_URL') . '/account/reset-password/' . $generatedPasswordResetToken;

        $mailData = [
            'token' => $generatedPasswordResetToken,
            'user' => $user,
            'actionUrl' => $actionUrl,
        ];

        Mail::to($request->email)->send(new PasswordResetEmail($mailData));

        return redirect()
            ->route('account.forgot.password')
            ->with('success', 'O link para redefinição de senha foi enviado para o seu e-mail.');
    }

    public function resetPassword($tokenString)
    {
        $token = DB::table('password_reset_tokens')->where('token', $tokenString)->first();

        if ($token == NULL) {
            return redirect()
                ->route('account.forgot.password')
                ->with('error', 'Token de redefinição de senha inválido!');
        }

        return view('front.account.reset-password', compact('tokenString'));
    }

    public function processResetPassword(Request $request)
    {
        $token = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if ($token == NULL) {
            return redirect()
                ->route('account.forgot.password')
                ->with('error', 'Token de redefinição de senha inválido!');
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('account.reset.password', $request->token)
                ->withErrors($validator);
        }

        User::where('email', $token->email)
            ->update(['password' => bcrypt($request->new_password)]);

        return redirect()
            ->route('account.login.index')
            ->with('success', 'Senha alterada com sucesso.');
    }

    public function verification($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user || $user->is_verified == 1) {
            return redirect('/');
        }

        $email = $user->email;

        $this->sendOtp($user);

        return view('front.account.otp-verification', compact('email'));
    }

    public function sendOtp($user)
    {
        $otp = rand(100000, 999999);
        $time = time();

        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'otp' => $otp,
                'created_at' => $time
            ]
        );

        $mailData = [
            'otp' => $otp,
            'name' => $user->name,
            'email' => $user->email,
            'title' => 'OTP de Verificação de E-mail',
            'subject' => 'OTP de Verificação de E-mail',
        ];

        Mail::to($user->email)->send(new MailEmailVerification($mailData));
    }

    public function verifiedOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('otp', $request->otp)->first();

        if (!$otpData) {
            return response()->json(
                [
                    'success' => false,
                    'msg' => 'Você inseriu um OTP incorreto'
                ]
            );
        } else {
            $currentTime = time();
            $time = $otpData->created_at;

            if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 segundos
                User::where('id', $user->id)->update([
                    'is_verified' => 1
                ]);
                return response()->json(
                    [
                        'success' => true,
                        'msg' => 'E-mail foi verificado'
                    ]
                );
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'msg' => 'Seu OTP expirou'
                    ]
                );
            }
        }
    }

    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('email', $request->email)->first();

        $currentTime = time();
        $time = $otpData->created_at;

        if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 segundos
            return response()->json(
                [
                    'success' => false,
                    'msg' => 'Por favor, tente novamente mais tarde'
                ]
            );
        } else {
            $this->sendOtp($user); // Enviar OTP

            return response()->json(
                [
                    'success' => true,
                    'msg' => 'OTP foi enviado'
                ]
            );
        }
    }
}
