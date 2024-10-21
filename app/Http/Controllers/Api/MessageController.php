<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use Auth;

class MessageController extends BaseController
{
    public function chat_list()
    {
        $data = Conversation::where('user_id',Auth::user()->id)->orwhere('target_id',Auth::user()->id)->get();
        return $this->sendResponse($data ,'Chat Lists');
    }
    
    public function message_list($id)
    {
        $data = Message::where('chat_id',$id)->get();
        return $this->sendResponse($data ,'Messages Lists');
    }
    
    public function sendMessage(Request $request)
    {
        $message = [
            'chat_id' => $request->chat_id,
            'target_id' => $request->target_id,
            'text' => $request->text,
            'createdAt' => $request->createdAt,
            'user' => $request->user,
        ];
    
        // Broadcast the event
        broadcast(new MessageSent((object)$message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }

}
