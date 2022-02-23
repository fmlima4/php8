<?php

namespace App\Listeners;

use App\User;
use App\Events\NewSerie;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailWhenNewSerie implements ShouldQueue
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
        $users = User::all();

        foreach($users as $index => $user) {
            $multiplicador = $index + 1;
            $email = new \App\Mail\NovaSerie( 
                $event->nome,
                $event->qtdTemporadas,
                $event->qtdEps
            );
    
            $email->subject = 'Nova serie Adicionada';
            $when = now()->addSeconds($multiplicador * 10);

            \Illuminate\Support\Facades\Mail::to($user)->later($when, $email);

        }
    }
}
