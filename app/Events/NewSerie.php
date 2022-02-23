<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $nome;
    public $qtdTemporadas;
    public $qtdEps;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($nome,$qtdTemporadas,$qtdEps)
    {
        $this->nome = $nome;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEps = $qtdEps;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
