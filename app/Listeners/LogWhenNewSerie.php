<?php

namespace App\Listeners;

use App\Events\NewSerie;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogWhenNewSerie implements ShouldQueue
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
     * @param  NewSerie  $event
     * @return void
     */
    public function handle(NewSerie $event)
    {
      
        \Log::info('Serie criada:'. $event->nome);
    }
}
