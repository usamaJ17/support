<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use App\DataTables\TicketDataTableUser;
use App\DataTables\TicketDataTableAdmin;
use App\DataTables\TicketDataTableAgent;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('role')=='user'){
            $datatable=new TicketDataTableUser;
        }
        elseif(session()->get('role')=='agent'){
            $datatable=new TicketDataTableAgent;
        }
        else{
            $datatable=new TicketDataTableAdmin;
        }
        return $datatable->render('ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'department' => 'required',
        ]); 
        $ticket=Ticket::create($request->all());
        if($ticket){
            if (request('file')){
                $name=uniqid().".".$request->file('file')->extension();
                $ticket->addMedia(request('file'))->usingName('ticket')->usingFileName($name)->toMediaCollection();
            }
            return response()->json([true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $replies=TicketReply::where('ticket_id','=',$ticket->id)->with('user')->orderBy('level', 'asc')->get();
        return view('ticket.show')->with(compact('ticket','replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
    public function change_status(Request $request)
    {
       $ticket=Ticket::find($request->id);
       $ticket->status=!($ticket->status);
       if($ticket->save()){
            return response()->json([true]); 
       };
       return response()->json([false]);
    }
    public function update_agent(Request $request)
    {
       $ticket=Ticket::find($request->id);
       $ticket->agent_id=($request->agent_id);
       if($ticket->save()){
            return response()->json([true]); 
       };
       return response()->json([false]);
    }
    public function store_reply(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]); 
        $reply=new TicketReply();
        $reply->message=$request->message;
        $reply->ticket_id=$request->ticket_id;
        $reply->user_id=session()->get('id');
        $level=TicketReply::where('ticket_id', $request->ticket_id)->max('level');
        $reply->level=++$level;
        if($reply->save()){
            if (request('file')){
                $name=uniqid().".".$request->file('file')->extension();
                $reply->addMedia(request('file'))->usingName('reply')->usingFileName($name)->toMediaCollection();
            }
            return response()->json([true]);
        }
    }
}
