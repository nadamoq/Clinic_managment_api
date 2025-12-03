<?php

namespace App\Providers;

use App\Models\Evaluation;
use App\Models\Patient;
use App\Observers\EvaluationObserver;
use App\Observers\PatientObserver;
use App\Policies\EvaluationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
        Patient::observe(PatientObserver::class);
        Evaluation::observe(EvaluationObserver::class);
        
    }
}
