<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_num = isset($request['page'])?$request['page']:1;
        $data = [];
        $data['page_num'] = $page_num;
        $data['rec_counter'] = (config('constants.PAGE_SIZE')*$page_num)-(config('constants.PAGE_SIZE')) + 1;

        $data['items'] = Channel::orderBy('created_at', 'desc')->paginate(config('constants.PAGE_SIZE'));        
        
        return view('channels.index', compact('data'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name'          =>  'required',
            'description'           =>  'required',            
            //'is_active'         =>  'required'
        ]);
        /*
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        */
        $user_id = auth()->user()->id; 

        $channel = new Channel();
        $channel->name = $request->name;
        $channel->description = $request->description;       
        $channel->user_id = $user_id;
        
        // $resp = f1();
        // if (!$resp['flag']) {
        //     return back()->withInput()->withErrors('These credentials are not verified. '.$resp['message']);
        //     exit;
        // } 

        $channel->save();

        return redirect()->route('channels.index')->with('success', 'Record added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        return view('channels.edit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $request->validate([
            'name'          =>  'required',
            'description'           =>  'required',           
        ]);

        $channel->name = $request->name;
        $channel->description = $request->description;        

        $channel->save();

        return redirect()->route('channels.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //$channel->delete();
        return redirect()->route('channels.index')->with('success', 'Record deleted successfully');
    }
}
