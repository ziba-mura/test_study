<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Student\Repository\StudentRepositoryInterface;
use Infrastructure\Repository\DbStudentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            StudentRepositoryInterface::class,
            DbStudentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
