<?php

namespace App\Listeners;

use App\Events\DashboardNotificationEvent;
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
    public $teacher;
    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DashboardNotificationEvent  $event
     * @return void
     */
    public function handle(DashboardNotificationEvent $event)
    {
        $adminRole = Role::where('name','admin')->first();
       
        if ($adminRole) {
        //    $adminUsers = $adminRole->teacher;
           Log::info('role data: ' . json_encode($adminRole));
           Notification::send($adminRole, new ($event->teacher));
       }
    }
}
