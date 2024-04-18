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

#### Publish Spatie Migrations

If already spatie installed, ignore this command

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

In terminal run first migration : php artisan migrate

#### Publish lbpm Migrations

php artisan vendor:publish --tag=migrations

In terminal run second migration : php artisan migrate

#### Publish lbpm Models

php artisan vendor:publish --tag=models

#### Publish lbpm Views 

php artisan vendor:publish --tag=views

#### Publish lbpm Controllers

php artisan vendor:publish --tag=controllers

#### Update providers in config/app.php

Spatie\Permission\PermissionServiceProvider::class,

Carifer\Lbpm\WorkflowServiceProvider::class

#### Publish lbpm routes

copy web.php from vendor/cariferdev/lbpm/routes/web.php and paste it in your routes file