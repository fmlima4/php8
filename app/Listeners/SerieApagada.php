<?php

namespace App\Listeners;

use App\Events\DeleteSerie;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class SerieApagada
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
     * @param  DeleteSerie  $event
     * @return void
     */
    public function handle(DeleteSerie $event)
    {
        $serie = $event->serie;
        if($serie->capa){
            Storage::delete($serie->capa);
        }
    }
}
