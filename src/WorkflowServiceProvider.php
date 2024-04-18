<?php

namespace Carifer\Lbpm;


use Illuminate\Support\ServiceProvider;

class WorkflowServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publishing migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // Publishing Views
        $this->publishes([
            __DIR__.'/../views' => resource_path('views'),
        ], 'views');

        //Publishing Controllers
        $this->publishes([
            __DIR__.'/../controllers' => app_path('Http/Controllers'),
        ], 'controllers');

        //routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // $this->registerControllers();
    }

    public function register()
    {
        //$this->registerControllers();
    }

    protected function registerControllers()
    {
        // Autoload package controllers
        $this->app->make('cariferdev\lbpm\controllers\PermissionController');
        $this->app->make('cariferdev\lbpm\controllers\ServiceController');
        $this->app->make('cariferdev\lbpm\controllers\RoleController');
        $this->app->make('cariferdev\lbpm\controllers\AssignRoleToUserController');
        $this->app->make('cariferdev\lbpm\controllers\WorkflowController');
        $this->app->make('cariferdev\lbpm\controllers\WorkflowStepController');
        $this->app->make('cariferdev\lbpm\controllers\ToClaimMyTaskController');
    }
}
