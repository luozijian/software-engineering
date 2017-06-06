<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMessage
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public $mobile;


    /**
     * Create a new event instance.
     *
     * @param $message
     * @param $mobile
     */
    public function __construct($mobile,$message)
    {
        $this->message = $message;
        $this->mobile = $mobile;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
