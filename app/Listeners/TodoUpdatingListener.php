<?php

namespace App\Listeners;

use App\Events\TodoUpdatingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TodoUpdatingListener
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
     * @param  \App\Events\TodoUpdatingEvent  $event
     * @return void
     */
    public function handle(TodoUpdatingEvent $event)
    {
        //
        var_dump('updating todo '.$event->todo);
    }
}
