<?php

namespace App\Providers;
use App\Repositories\AssignmentRepositoryEloquent;
use App\Repositories\AssignmentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\AssignmentRepository', 'App\Repositories\AssignmentRepositoryEloquent');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
