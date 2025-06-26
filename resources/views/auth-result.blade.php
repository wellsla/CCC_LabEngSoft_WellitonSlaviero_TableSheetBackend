<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #121b23;
            background: linear-gradient(135deg, #bc360e 0%, #eec76a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(18, 27, 35, 0.2);
            max-width: 500px;
            width: 100%;
            overflow: hidden;
        }

        .header {
            background-color: #bc360e;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .header h2 {
            font-size: 18px;
            font-weight: normal;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
            text-align: center;
        }

        .icon {
            font-size: 64px;
            margin-bottom: 20px;
            display: block;
        }

        .success-icon {
            color: #bc360e;
        }

        .error-icon {
            color: #dc2626;
        }

        .message {
            font-size: 18px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .description {
            color: #121b23;
            opacity: 0.8;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            background-color: #bc360e;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .button:hover {
            background-color: #9a2d0b;
        }

        .button-secondary {
            background-color: transparent;
            color: #bc360e;
            border: 2px solid #bc360e;
        }

        .button-secondary:hover {
            background-color: #bc360e;
            color: white;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #eec76a;
        }

        .footer p {
            font-size: 14px;
            color: #121b23;
            opacity: 0.7;
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
            }

            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content {
                padding: 30px 20px;
            }

            .icon {
                font-size: 48px;
            }

            .message {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
            <h2>{{ $title }}</h2>
        </div>

        <div class="content">
            <span class="icon {{ $success ? 'success-icon' : 'error-icon' }}">
                {{ $success ? '✅' : '❌' }}
            </span>

            <div class="message">
                {{ $message }}
            </div>

            @if($description)
                <div class="description">
                    {{ $description }}
                </div>
            @endif

            <div class="actions">
                @if($type === 'email_verification')
                    @if($success)
                        <a href="{{ $frontendUrl }}/login" class="button">Fazer Login</a>
                        <a href="{{ $frontendUrl }}" class="button button-secondary">Ir para Início</a>
                    @else
                        <a href="{{ $frontendUrl }}/resend-verification" class="button">Reenviar E-mail</a>
                        <a href="{{ $frontendUrl }}/login" class="button button-secondary">Voltar ao Login</a>
                    @endif
                @elseif($type === 'password_reset')
                    @if($success)
                        <a href="{{ $frontendUrl }}/login" class="button">Fazer Login</a>
                        <a href="{{ $frontendUrl }}" class="button button-secondary">Ir para Início</a>
                    @else
                        <a href="{{ $frontendUrl }}/forgot-password" class="button">Solicitar Novo Link</a>
                        <a href="{{ $frontendUrl }}/login" class="button button-secondary">Voltar ao Login</a>
                    @endif
                @else
                    <a href="{{ $frontendUrl }}" class="button">Voltar ao Início</a>
                @endif
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
