<?php

namespace App\Providers;

use App\Repositories\ClassesRepository;
use App\Repositories\ClassesRepositoryEloquent;
use App\Repositories\StudentRepository;
use App\Repositories\StudentRepositoryEloquent;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ClassesRepository::class, ClassesRepositoryEloquent::class);
        $this->app->bind(StudentRepository::class, StudentRepositoryEloquent::class);
        //:end-bindings:
    }
}
