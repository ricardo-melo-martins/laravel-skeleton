<?php

namespace App\Modules\Users\Listeners;

use App\Modules\Users\Events\UserRegistered;
use Illuminate\Support\Facades\Log;

class SendUserRegisteredWelcome
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
     * @param UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event): void
    {
        // TODO: implementar envio de email
        Log::debug($event->user);

    }
}
