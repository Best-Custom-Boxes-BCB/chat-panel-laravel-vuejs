<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public $username;
    public $channel_name;
    public $visitor_id;
    public $agent_id;

    public function __construct($message,$username,$channel_name)
    {
        $this->message = $message;
        $this->username = $username;
        $this->channel_name = $channel_name;
    }

    public function broadcastOn()
    {
        return new Channel($this->channel_name);
    }

    public function broadcastAs()
    {
        return 'message';
    }
}
