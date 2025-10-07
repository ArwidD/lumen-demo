<?php

namespace App\Providers;

use App\Repositories\Implementations\JsonUppgiftRepo;
use App\Repositories\Interfaces\UppgiftRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(UppgiftRepo::class, JsonUppgiftRepo::class);
    }
}