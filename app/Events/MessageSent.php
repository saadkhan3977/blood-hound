<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Auth;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        // print_r(Auth::user()->id);die;
        $chat = Conversation::where('chat_id',request()->chat_id)->where('user_id',Auth::user()->id)->orwhere('target_id',Auth::user()->id)->first();
        // print_r($chat);die;
        if(!$chat)
        {
            Conversation::create([
                'chat_id' => request()->chat_id,
                'user_id' => Auth::user()->id,
                'target_id' => request()->target_id,
            ]);

        }
        Message::create([
            'chat_id' => request()->chat_id,
            'user_id' => Auth::user()->id,
            'target_id' => request()->target_id,
            'text' => request()->text
        ]);
        return new PrivateChannel('chat.' . $this->message->chat_id);
    }

    public function broadcastWith()
    {
        return ['message' => $this->message];
    }
}