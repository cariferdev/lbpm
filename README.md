# lbpm
Laravel Business Process Management

## Installtion

#### Alter composer.json file

 "repositories": [
        {
            "type": "git",
            "url": "https://github.com/cariferdev/lbpm.git"
        }
    ],
"require": 
{
    "cariferdev/lbpm":"dev-main"
},

In terminal run : composer update

#### Spatie Publish
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

#### Publish Migrations

php artisan vendor:publish --tag=migrations

#### Publish Views 

php artisan vendor:publish --tag=views

#### Publish Controllers

php artisan vendor:publish --tag=controllers

#### Update providers in config/app.php

Spatie\Permission\PermissionServiceProvider::class,

Carifer\Lbpm\WorkflowServiceProvider::class

#### Run Migration

php artisan migrate