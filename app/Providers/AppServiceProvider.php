<?php

namespace App\Providers;

use App\Models\Status;
use App\Models\Applicant;
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
        Schema::defaultStringLength(191);
        $statuses = Status::all();
        view()->share('statuses', $statuses);

        $countPendingAll = Applicant::where('approve_id', null)
        ->whereNull('done')
        ->count();
        view()->share('countPendingAll', $countPendingAll);

        $countPending = Applicant::where('approve_id', null)
        ->where('status_id', '=', 0)
        ->whereNull('done')
        ->count();
        view()->share('countPending', $countPending);
    }
}
