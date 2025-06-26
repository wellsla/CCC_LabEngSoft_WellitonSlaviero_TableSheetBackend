<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha - {{ config('app.name') }}</title>
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
        .security-notice {
            background-color: #f8f9fa;
            border: 1px solid #121b23;
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
        <h2>Redefinição de Senha</h2>
    </div>

    <div class="content">
        <p>Olá!</p>

        <p>Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta no {{ config('app.name') }}.</p>

        <p>Clique no botão abaixo para redefinir sua senha:</p>

        <div style="text-align: center;">
            <a href="{{ $actionUrl }}" class="button">Redefinir Senha</a>
        </div>

        <div class="warning">
            <strong>⚠️ Importante:</strong> Este link de redefinição expira em 60 minutos por motivos de segurança.
        </div>

        <p>Se você não conseguir clicar no botão, copie e cole o link abaixo no seu navegador:</p>
        <p class="url-box">
            {{ $actionUrl }}
        </p>

        <div class="security-notice">
            <strong>🔒 Aviso de Segurança:</strong> Se você não solicitou a redefinição de senha, ignore este e-mail. Sua senha permanecerá inalterada. Recomendamos que você verifique a segurança de sua conta se recebeu este e-mail sem ter solicitado.
        </div>

        <p>Após redefinir sua senha, você poderá fazer login normalmente no {{ config('app.name') }}.</p>

        <div class="footer">
            <p>Atenciosamente,<br>
            Equipe {{ config('app.name') }}</p>

            <p><small>Este é um e-mail automático, por favor não responda.</small></p>
        </div>
    </div>
</body>
</html>
