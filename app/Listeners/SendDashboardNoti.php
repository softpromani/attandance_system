<?php

namespace App\Listeners;

use App\Events\DashboardNotificationEvent;
use App\Notifications\DashboardNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class SendDashboardNoti
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DashboardNotificationEvent  $event
     * @return void
     */
    public function handle(DashboardNotificationEvent $event)
    {
        Log::info('event data: ' . json_encode($event));
        $adminRole = Role::where('name','admin')->first();
       
        if ($adminRole) {
           $adminUsers = $adminRole->Users;
           Notification::send($adminUsers, new DashboardNotification($event->teacher));
       }
    }
}
