<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email de Notificação de Vaga</title>
</head>

<body>
    <h1>Olá {{ $mailData['employer']->name }}</h1>

    <p>Título da Vaga: {{ $mailData['job']->title }}</p>

    <p>Detalhes do Candidato:</p>

    <p>Nome: {{ $mailData['user']->name }}</p>
    <p>Email: {{ $mailData['user']->email }}</p>
    <p>Telefone: {{ $mailData['user']->mobile }}</p>

</body>

</html>