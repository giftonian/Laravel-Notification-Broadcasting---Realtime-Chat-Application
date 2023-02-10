<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\ChatMessageEvent;

class ChatController extends Controller
{

    /**
     * Display the index page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $channels = Channel::get();
        return view('dashboard', compact('channels'));
    }

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function chat(Request $request)
    {
        return view('chat_ui_2');
    }

    public function chatRoom(Request $request, $channel_id)
    {
        // $page_num = isset($request['page'])?$request['page']:1;
        // $data = [];
        // $data['page_num'] = $page_num;
        // $data['rec_counter'] = (config('constants.PAGE_SIZE')*$page_num)-(config('constants.PAGE_SIZE')) + 1;  
        
        // $data['campaign']       = campaignDetailById($campaign_sent_id);
        // $data['stats']          = campaignStatsById($campaign_sent_id);
        // $data['total_receivers'] = sizeof($data['stats']); 
        // $data['total_clicks']   = 0;
        
        // foreach ($data['stats'] as $row) {
        //     $data['total_clicks'] += $row->click_count;            
        // }
        $channel   = Channel::find($channel_id);
        $messages  = $channel->messages()
        ->orderBy('id', 'ASC')
        ->get();
        
        //dd($messages);
        // foreach ($messages as $index => $msg) {
        //     echo '<pre>';
        //     print_r($msg->message);
        //     print_r($msg->user->name);
        //     print_r($msg->user->id);
        // }
        // exit;

        $data['channel_id'] = $channel->id;
        $data['channel_name'] = $channel->name;
        return view('chat_ui_2', compact(['data', 'messages']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMessage(Request $request)
    {
        $notAllowed = false;
        $request->validate([
            'message'          =>  'required|min:1|max:1000',
            'channel_id'        => 'required'           
        ]);
        $user_id = auth()->user()->id; 

        $message = new Message();

        $message->user_id = $user_id;
        $message->channel_id = $request->channel_id;
        $message->message = $request->message;

        $saved = $message->save();
        if ($saved) {
            event(new ChatMessageEvent($request->channel_id, $request->message, auth()->user()));
        } else {
            $notAllowed = true;
        }
        
        // return $this->jsonResponse([
        //     'new_message_is_added' => true,
        //     'message' => 'Your new message is successfully created.',
        //     'message_info' => $message,
        // ]);

        if ($notAllowed) {
            return $this->jsonResponse([
                'message' => 'Not Acceptable',
            ], 406, false);
        } else {
            return null;
        }
    }
}
