<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RedirectAfterLoginListener
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Redirect logic is usually handled by Fortify/Jetstream config, preventing this listener from returning a response.
        // If custom redirect is needed, it should be done in the response handling, not a listener.
        // For now, removing the return to fix the linter error.
    }
}
