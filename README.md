### Instalar dependências
```cmd
composer install
```

### Defina uma alias para os comandos do laravel sail
```cmd
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

### Suba o laravel Sail (Garanta que o docker esteja rodando)
```cmd
sail up -d
```

### Rode as migrations do banco de dados
```cmd
sail php artisan migrate
```

### Reverta as migrations do banco de dados caso necessario
```cmd
sail php artisan migrate:rollback
```

### Popule o banco de dados
```cmd
sail php artisan db:seed --class=SuperUserSeeder
```

## Dicas de projeto:

### Criar model
```cmd
sail php artisan make:model NomeDaModel

Opções úteis:
    -m: já cria a migration junto.
    -f: já cria a factory.
    -s: já cria o seeder.
    -c: já cria o controller.
```

### Criar apenas migration
```cmd
sail php artisan make:migration nome_da_migration
```

### Criar apenas migration de alteração específica
```cmd
php artisan make:migration add_nome_da_coluna_to_nome_da_tabela_table --table=nome_da_tabela
```

### Pular migration se ja tiver sido executada
```cmd
php artisan migrate --pretend
```

### Rodar migration específica
```cmd
php artisan migrate --path=/database/migrations/2025_03_30_XXXXXX_nome_da_migration.php
```

### Criar controller
```cmd
sail php artisan make:controller NomeDaController

Opções úteis:
    --resource: gera métodos RESTful (index, create, store, etc.).
    --model=NomeDoModel: gera métodos já “amarrados” a um model.
```

### Criar request
```cmd
sail php artisan make:request NomeDaFormRequest
```

### Criar factory
```cmd
sail php artisan make:factory NomeDaFactory
```

### Criar seeder
```cmd
sail php artisan make:seeder NomeDoSeeder
```

### Criar resource
```cmd
sail php artisan make:resource NomeDoResource
```

### Criar automaticamente um link simbólico para storage
```cmd
sail php artisan storage:link
```
