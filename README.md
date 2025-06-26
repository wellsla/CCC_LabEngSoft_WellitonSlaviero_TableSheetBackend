Baseado no seu README original, segue a versão totalmente traduzida para o português, com variações de cada comando para Linux (bash) e para Windows (PowerShell com WSL2):

---

# Backend do TableSheet

O Backend do TableSheet é uma API baseada em Laravel para gerenciamento de fichas de personagens de RPG de mesa. Fornece uma plataforma robusta para criar, gerenciar e compartilhar fichas de personagens para diversos sistemas de RPG de mesa.

## Sumário

* [Pré-requisitos](#pré-requisitos)
* [Instalação](#instalação)
* [Executando a Aplicação](#executando-a-aplicação)
* [Diretrizes de Desenvolvimento](#diretrizes-de-desenvolvimento)
* [Documentação da API](#documentação-da-api)
* [Comandos Úteis](#comandos-úteis)
* [Estrutura do Projeto](#estrutura-do-projeto)

## Pré-requisitos

* Docker e Docker Compose
* Git

**Windows (PowerShell):**

* Docker Desktop para Windows (inclui Docker Compose)
* Git para Windows (Git Bash ou PowerShell)

## Instalação

1. **Clonar o repositório**
   **Linux (bash):**

   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

   **Windows (PowerShell):**

   ```powershell
   git clone <repository-url>
   Set-Location <repository-directory>
   ```

2. **Criar arquivo `.env`**
   **Linux (bash):**

   ```bash
   cp .env.example .env
   ```

   **Windows (PowerShell):**

   ```powershell
   Copy-Item .env.example .env
   ```

3. **Configurar variáveis de ambiente**
   No arquivo `.env`, defina:

   ```
   APP_NAME=TableSheet
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=pgsql
   DB_HOST=pgsql
   DB_PORT=5432
   DB_DATABASE=tablesheet
   DB_USERNAME=sail
   DB_PASSWORD=password
   ```

4. **Configurar o Laravel Sail**
   **Linux (bash):**

   ```bash
   alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
   ```

   **Windows (PowerShell com WSL2):**

    * Para usar diretamente via WSL:

      ```powershell
      Set-Alias sail "bash vendor/bin/sail"
      ```
    * Ou execute sem alias:

      ```powershell
      bash vendor/bin/sail up -d
      ```

5. **Iniciar os containers Docker**
   **Linux (bash):**

   ```bash
   sail up -d
   ```

   **Windows (PowerShell):**

   ```powershell
   sail up -d
   ```

   *Ou sem alias:*

   ```powershell
   bash vendor/bin/sail up -d
   ```

6. **Instalar dependências**
   **Linux (bash):**

   ```bash
   sail composer install
   ```

   **Windows (PowerShell):**

   ```powershell
   sail composer install
   ```

7. **Gerar chave de aplicação**
   **Linux (bash):**

   ```bash
   sail php artisan key:generate
   ```

   **Windows (PowerShell):**

   ```powershell
   sail php artisan key:generate
   ```

8. **Executar migrations**
   **Linux (bash):**

   ```bash
   sail php artisan migrate
   ```

   **Windows (PowerShell):**

   ```powershell
   sail php artisan migrate
   ```

9. **Popular o banco (opcional)**
   **Linux (bash):**

   ```bash
   sail php artisan db:seed
   ```

   **Windows (PowerShell):**

   ```powershell
   sail php artisan db:seed
   ```

## Executando a Aplicação

Após a instalação, a aplicação estará disponível em `http://localhost`. A API pode ser acessada em `http://localhost/api`.

**Para iniciar e parar a aplicação:**

* **Iniciar**

  ```bash
  sail up -d        # Linux
  ```

  ```powershell
  sail up -d        # Windows
  ```

  *Ou sem alias:*

  ```powershell
  bash vendor/bin/sail up -d
  ```

* **Parar**

  ```bash
  sail down         # Linux
  ```

  ```powershell
  sail down         # Windows
  ```

  *Ou sem alias:*

  ```powershell
  bash vendor/bin/sail down
  ```

## Mailpit - Teste de E-mails

O projeto está configurado com Mailpit para capturar e visualizar e-mails enviados durante o desenvolvimento.

### Acessando o Mailpit

Após iniciar os containers Docker, o Mailpit estará disponível em:

* **Interface Web:** `http://localhost:8025`
* **SMTP Server:** `localhost:1025`

### Testando o Envio de E-mails

Para testar se o Mailpit está funcionando corretamente:

1. **Via rota de teste (apenas em ambiente local):**

   ```bash
   # Linux
   curl http://localhost/api/test-mail
   ```

   ```powershell
   # Windows
   Invoke-RestMethod -Uri "http://localhost/api/test-mail" -Method Get
   ```

2. **Via funcionalidades da aplicação:**
   * Registrar um novo usuário (envia e-mail de verificação)
   * Solicitar redefinição de senha
   * Reenviar e-mail de verificação

### Configuração

As configurações do Mailpit estão no arquivo `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
FORWARD_MAILPIT_PORT=1025
FORWARD_MAILPIT_DASHBOARD_PORT=8025
```

**Nota:** Todos os e-mails enviados pela aplicação serão capturados pelo Mailpit e não serão enviados para destinatários reais.

## Diretrizes de Desenvolvimento

### Arquitetura

O projeto segue uma arquitetura MVC simplificada:

1. **Controladores (Controllers):** Tratam requisições HTTP e respostas
2. **Modelos (Models):** Representam entidades do banco e acesso a dados

### Padrão de Código

Adote o padrão PSR-12. Pontos-chave:

* CamelCase para métodos e variáveis
* PascalCase para nomes de classes
* snake\_case para colunas de banco
* Nomes significativos e descritivos

### Formato de Resposta da API

Respostas de sucesso retornam objetos JSON simples:

```json
{
  "id": 1,
  "name": "Exemplo",
  "created_at": "2023-01-01T00:00:00.000000Z",
  "updated_at": "2023-01-01T00:00:00.000000Z"
}
```

Respostas de erro:

```json
{
  "message": "Mensagem de erro"
}
```

## Documentação da API

### Autenticação

* `POST /api/register` – Registrar novo usuário
* `POST /api/login` – Autenticar usuário
* `POST /api/logout` – Encerrar sessão
* `GET /api/me` – Dados do usuário autenticado

### Jogos (Games)

* `GET /api/games` – Listar jogos (público)
* `POST /api/games` – Criar jogo (admin)
* `GET /api/games/{id}` – Detalhes de jogo (público)
* `PUT /api/games/{id}` – Atualizar jogo (admin)
* `DELETE /api/games/{id}` – Excluir jogo (admin)

### Fichas de Personagem

* `GET /api/character-sheets` – Listar fichas do usuário
* `POST /api/character-sheets` – Criar ficha
* `GET /api/character-sheets/{id}` – Detalhes da ficha
* `PUT /api/character-sheets/{id}` – Atualizar ficha
* `DELETE /api/character-sheets/{id}` – Excluir ficha

### Classes e Raças

* `GET /api/classes` / `GET /api/races` – Listar
* `GET /api/classes/{id}` / `GET /api/races/{id}` – Detalhes
* `POST /api/classes` / `POST /api/races` – Criar (admin)
* `PUT /api/classes/{id}` / `PUT /api/races/{id}` – Atualizar (admin)
* `DELETE /api/classes/{id}` / `DELETE /api/races/{id}` – Excluir (admin)

Para documentação completa, acesse a documentação Scribe em `http://localhost:8000/docs` após executar o comando de geração de documentação.

### Collection Postman com Token Dinâmico

O projeto inclui uma collection Postman especial (`postman_collection_dynamic.json`) que oferece gerenciamento automático de tokens de autenticação:

- **Captura Automática**: O token é automaticamente capturado da resposta do login
- **Reutilização Automática**: O token é automaticamente usado em todas as requisições autenticadas
- **Limpeza Automática**: O token é limpo automaticamente no logout

Para usar a collection dinâmica, consulte o guia detalhado em `POSTMAN_DYNAMIC_TOKEN_GUIDE.md`.

## Comandos Úteis

### Comandos do Artisan / Sail

#### Migrations de Banco de Dados

```bash
# Linux
sail php artisan migrate
sail php artisan migrate:rollback
sail php artisan migrate --pretend
sail php artisan migrate --path=/database/migrations/specific_migration.php
```

```powershell
# Windows
sail php artisan migrate
sail php artisan migrate:rollback
sail php artisan migrate --pretend
sail php artisan migrate --path=/database/migrations/specific_migration.php
```

#### Seeders

```bash
# Linux
sail php artisan db:seed
sail php artisan db:seed --class=SuperUserSeeder
```

```powershell
# Windows
sail php artisan db:seed
sail php artisan db:seed --class=SuperUserSeeder
```

#### Criar Models

```bash
# Linux
sail php artisan make:model ModelName
sail php artisan make:model ModelName -m -f -s -c
```

```powershell
# Windows
sail php artisan make:model ModelName
sail php artisan make:model ModelName -m -f -s -c
```

#### Criar Controllers

```bash
# Linux
sail php artisan make:controller ControllerName
sail php artisan make:controller ControllerName --resource
sail php artisan make:controller ControllerName --model=ModelName
```

```powershell
# Windows
sail php artisan make:controller ControllerName
sail php artisan make:controller ControllerName --resource
sail php artisan make:controller ControllerName --model=ModelName
```

#### Outras Criações

```bash
# Linux
sail php artisan make:request RequestName
sail php artisan make:factory FactoryName
sail php artisan make:seeder SeederName
sail php artisan make:resource ResourceName
```

```powershell
# Windows
sail php artisan make:request RequestName
sail php artisan make:factory FactoryName
sail php artisan make:seeder SeederName
sail php artisan make:resource ResourceName
```

#### Storage e Cache

```bash
# Linux
sail php artisan storage:link
sail php artisan config:clear
sail php artisan cache:clear
sail php artisan view:clear
```

```powershell
# Windows
sail php artisan storage:link
sail php artisan config:clear
sail php artisan cache:clear
sail php artisan view:clear
```

#### Refresh Geral

```bash
# Linux
sail composer dump-autoload
sail php artisan optimize:clear
sail php artisan migrate:fresh --seed
```

```powershell
# Windows
sail composer dump-autoload
sail php artisan optimize:clear
sail php artisan migrate:fresh --seed
```

#### Scribe (Geração de Docs)

```bash
# Linux
sail php artisan scribe:generate --force
```

```powershell
# Windows
sail php artisan scribe:generate --force
```

## Estrutura do Projeto

* `app/Http/Controllers` – Controladores
* `app/Http/Requests` – Requisições de validação
* `app/Models` – Modelos Eloquent
* `database/migrations` – Migrations
* `database/seeders` – Seeders
* `routes` – Rotas da API
* `docs` – Documentação adicional

---
