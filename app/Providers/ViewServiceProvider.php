<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\ViewComposers\RoomComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
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
        View::composer('admin.partials.modals.room-modal', RoomComposer::class);
        //View::composer('admin.partials.modals.student-dormitory-modal', RoomComposer::class);
        //View::composer('student.home', StudentCampaignComposer::class);
    }
}
