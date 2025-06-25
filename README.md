# TableSheet Backend

TableSheet Backend is a Laravel-based API for tabletop RPG character sheet management. It provides a robust platform for creating, managing, and sharing character sheets for various tabletop RPG systems.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Running the Application](#running-the-application)
- [Development Guidelines](#development-guidelines)
- [API Documentation](#api-documentation)
- [Useful Commands](#useful-commands)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)

## Prerequisites

- [Docker](https://www.docker.com/products/docker-desktop) and Docker Compose
- [Git](https://git-scm.com/downloads)

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Create a `.env` file by copying the example:
   ```bash
   cp .env.example .env
   ```

3. Configure essential environment variables in `.env`:
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

4. Set up Laravel Sail for your operating system:

   ```bash
   alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
   ```

5. Start the Docker containers:
   ```bash
   sail up -d
   ```

6. Install dependencies:
   ```bash
   sail composer install
   ```

7. Generate an application key:
   ```bash
   sail php artisan key:generate
   ```

8. Run migrations:
   ```bash
   sail php artisan migrate
   ```

9. Seed the database (if needed):
   ```bash
   sail php artisan db:seed
   ```

## Running the Application

After installation, the application should be running at `http://localhost`. You can access the API at `http://localhost/api`.

To start/stop the application:

```bash
# Start the application
sail up -d

# Stop the application
sail down
```

## Development Guidelines

### Architecture

The project follows a simplified MVC architecture:

1. **Controllers**: Handle HTTP requests and responses
2. **Models**: Represent database entities and handle data access

### Code Style

The project follows the PSR-12 coding standard. Key points:

- Use camelCase for method names and variables
- Use PascalCase for class names
- Use snake_case for database columns
- Use meaningful and descriptive names

### API Response Format

API responses are simple JSON objects.

Success response with data:
```json
{
  "id": 1,
  "name": "Example",
  "created_at": "2023-01-01T00:00:00.000000Z",
  "updated_at": "2023-01-01T00:00:00.000000Z"
}
```

Error response:
```json
{
  "message": "Error message"
}
```


## API Documentation

The API provides simple endpoints for managing tabletop RPG character sheets. Here are the core endpoints:

### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Log in with existing credentials
- `POST /api/logout` - Log out and invalidate the current token
- `GET /api/me` - Get current user information

### Games (Public + Admin)
- `GET /api/games` - List all games (public)
- `POST /api/games` - Create a new game (admin only)
- `GET /api/games/{id}` - Get game details (public)
- `PUT /api/games/{id}` - Update a game (admin only)
- `DELETE /api/games/{id}` - Delete a game (admin only)

### Character Sheets
- `GET /api/character-sheets` - List user's character sheets
- `POST /api/character-sheets` - Create a new character sheet
- `GET /api/character-sheets/{id}` - Get character sheet details
- `PUT /api/character-sheets/{id}` - Update a character sheet
- `DELETE /api/character-sheets/{id}` - Delete a character sheet

### Classes
- `GET /api/classes` - List all classes
- `GET /api/classes/{id}` - Get class details
- `POST /api/classes` - Create a new class (admin only)
- `PUT /api/classes/{id}` - Update a class (admin only)
- `DELETE /api/classes/{id}` - Delete a class (admin only)

### Races
- `GET /api/races` - List all races
- `GET /api/races/{id}` - Get race details
- `POST /api/races` - Create a new race (admin only)
- `PUT /api/races/{id}` - Update a race (admin only)
- `DELETE /api/races/{id}` - Delete a race (admin only)

For more detailed API documentation, see [docs/api_documentation.md](docs/api_documentation.md).

## Useful Commands

### Laravel Artisan Commands

```bash
# Database migrations
sail php artisan migrate
sail php artisan migrate:rollback
sail php artisan migrate --pretend
sail php artisan migrate --path=/database/migrations/specific_migration.php

# Database seeding
sail php artisan db:seed
sail php artisan db:seed --class=SuperUserSeeder

# Creating models
sail php artisan make:model ModelName
sail php artisan make:model ModelName -m -f -s -c

# Creating controllers
sail php artisan make:controller ControllerName
sail php artisan make:controller ControllerName --resource
sail php artisan make:controller ControllerName --model=ModelName

# Creating other components
sail php artisan make:request RequestName
sail php artisan make:factory FactoryName
sail php artisan make:seeder SeederName
sail php artisan make:resource ResourceName

# Storage and cache
sail php artisan storage:link
sail php artisan config:clear
sail php artisan cache:clear
sail php artisan view:clear
```

## Project Structure

The project follows a standard Laravel structure:

- `app/Http/Controllers`: Controllers for handling HTTP requests
- `app/Http/Requests`: Form requests for validation
- `app/Models`: Eloquent models for database interaction
- `database/migrations`: Database migrations
- `database/seeders`: Database seeders
- `routes`: API routes
- `docs`: Project documentation
