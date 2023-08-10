<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\TodoEvent;


class TodoListener
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
     * @param  \App\Events\TodoEvent  $event
     * @return void
     */
    public function handle(TodoEvent $event)
    {
        //
        // dd('la nouvelle task est : '. $event->todo->task);
        dd('le todo a ete save'. $event->todo);
    }
}
