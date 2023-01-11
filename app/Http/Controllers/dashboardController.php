<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;

class dashboardController extends Controller
{
    public function index()
    {
       if(session()->has('id')){
            $user=User::find(session()->get('id'));
            if($user->role=='admin'){
                return view('dashboard.dashboard_admin')->with(compact('user'));       
            }
            else if($user->role=='agent'){
                $tickets=Ticket::where('agent_id','=',$user->id)->get();
                return view('dashboard.dashboard_agent')->with(compact('user','tickets'));       
            }
            else if($user->role=='user'){
                $tickets=Ticket::where('user_id','=',$user->id)->get();
                return view('dashboard.dashboard_user')->with(compact('user','tickets'));      
            }
       }
       else{
        return redirect(url('/signin'));
       }
    }
}
