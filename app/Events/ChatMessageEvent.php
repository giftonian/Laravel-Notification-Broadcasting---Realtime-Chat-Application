<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ChatMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $message;
    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $message) // passing User $user for Private channel communication
    {
       $this->message = $message;       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       
        return new Channel('public.chat.1'); // this is Public channel, requires no authentication
        // above line commented to test Private channel working
    }

    public function broadcastAs() // for our own Event name, instead of full ClassName
    {
        return 'chat-message';
    }

    public function broadcastWith() // generating an event with a payload/data
    {
        return [
            //'name' => 'Waqas Tariq - 34201-1828638-1'
            'message' => $this->message
        ];
    }
}
