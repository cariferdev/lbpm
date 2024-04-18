# lbpm
Laravel Business Process Management

## Installtion
### Publish Migrations

php artisan vendor:publish --tag=migrations

### Publish Views 

php artisan vendor:publish --tag=views

### Publish Controllers

php artisan vendor:publish --tag=controllers

### Update providers in config/app.php

Carifer\Lbpm\WorkflowServiceProvider::class