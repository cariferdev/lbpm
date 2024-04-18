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

        // Publishing Models
        $this->publishes([
            __DIR__.'/../models' => app_path('Models'),
        ], 'models');

        //routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function register()
    {

    }

}
