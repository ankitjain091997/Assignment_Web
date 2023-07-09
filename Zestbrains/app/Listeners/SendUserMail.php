<?php

namespace App\Listeners;

use App\Events\EmailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserMail
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
     * @param  \App\Events\EmailEvent  $event
     * @return void
     */
    public function handle(EmailEvent $event)

    {
        $user = $event->user;
        Mail::to($user->email)->send(new \App\Mail\RegistrationEmail($user));
        //
    }
}