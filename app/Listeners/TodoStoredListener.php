<?php

namespace App\Listeners;

use App\Events\TodoStoredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TodoStoredListener
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
     * @param  \App\Events\TodoStoredEvent  $event
     * @return void
     */
    public function handle(TodoStoredEvent $event)
    {
        //
        var_dump('stored');
    }
}
