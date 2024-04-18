# lbpm
Laravel Business Process Management

## Installtion
#### Publish Migrations

php artisan vendor:publish --tag=migrations

#### Publish Views 

php artisan vendor:publish --tag=views

#### Publish Controllers

php artisan vendor:publish --tag=controllers

#### Update providers in config/app.php

Spatie\Permission\PermissionServiceProvider::class,

Carifer\Lbpm\WorkflowServiceProvider::class

#### Spatie Publish
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"


#### Run Migration

php artisan migrate