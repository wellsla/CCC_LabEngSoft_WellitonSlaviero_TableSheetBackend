<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de E-mail - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #121b23;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #bc360e;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 10px rgba(18, 27, 35, 0.1);
        }
        .button {
            display: inline-block;
            background-color: #bc360e;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #9a2d0b;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eec76a;
            font-size: 14px;
            color: #121b23;
            opacity: 0.8;
        }
        .warning {
            background-color: #fef9e7;
            border: 1px solid #eec76a;
            color: #121b23;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .url-box {
            word-break: break-all;
            background-color: #f8f9fa;
            border: 1px solid #eec76a;
            padding: 10px;
            border-radius: 4px;
            color: #121b23;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <h2>Verificação de E-mail</h2>
    </div>

    <div class="content">
        <p>Olá!</p>

        <p>Obrigado por se registrar no {{ config('app.name') }}! Para completar seu cadastro, você precisa verificar seu endereço de e-mail.</p>

        <p>Clique no botão abaixo para verificar seu e-mail:</p>

        <div style="text-align: center;">
            <a href="{{ $actionUrl }}" class="button">Verificar E-mail</a>
        </div>

        <div class="warning">
            <strong>⚠️ Importante:</strong> Este link de verificação expira em 5 minutos por motivos de segurança.
        </div>

        <p>Se você não conseguir clicar no botão, copie e cole o link abaixo no seu navegador:</p>
        <p class="url-box">
            {{ $actionUrl }}
        </p>

        <p>Se você não criou uma conta no {{ config('app.name') }}, pode ignorar este e-mail com segurança.</p>

        <div class="footer">
            <p>Atenciosamente,<br>
            Equipe {{ config('app.name') }}</p>

            <p><small>Este é um e-mail automático, por favor não responda.</small></p>
        </div>
    </div>
</body>
</html>
