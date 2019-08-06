## Installation

Install PHP dependencies via Composer.

```bash
composer install
```

> After running the command "`composer install`", the .env file is automatically copied from the .env.example file and the application key is also generated. You needn't to initialize them manually.

Run docker in project

```bash
docker-compose up -d
```

Set these environment variables (see .env file).

```txt
DB_CONNECTION=mysql
DB_HOST=php_training_mysql
DB_PORT=3306
DB_DATABASE=php_training
DB_USERNAME=root
DB_PASSWORD=root
```

Bash to container docker

```bash
docker exec -it php_training_workspace bash
```

Migrate and run the default seeder.

```bash
php artisan migrate --seed
```


Install laravel passport

```bash
php artisan passport:install 
```
