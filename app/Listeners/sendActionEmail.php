<?php

namespace App\Listeners;

use App\Events\Action;
use App\Mail\ActionMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class sendActionEmail
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
     * @param  \App\Events\Action.php  $event
     * @return void
     */
    public function handle(Action $event)
    {
        $user = $event->user;
            Mail::to($user->email)->send(new ActionMail($user));
    }
}
