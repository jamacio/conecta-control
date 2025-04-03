<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cep', 10)->after('email');
            $table->string('street')->after('cep');
            $table->string('number')->after('street');
            $table->string('city')->after('number');
            $table->string('state')->after('city')->default('São Paulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cep', 'street', 'number', 'city', 'state']);
        });
    }
};
