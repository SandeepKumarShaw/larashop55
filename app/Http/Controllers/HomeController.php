<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inbox;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function myaccount($link =''){
        return view('myaccount.index',compact('link'));
    }
    public function inbox(){
        $user_id = Auth::user()->id;
        $inbox = Inbox::where('user_id', '=', $user_id)->get();
        return view('myaccount.inbox',compact('inbox'));
    }
    public function updateInbox(Request $request){
        $mId = $request->msgId;
        $Inbox = Inbox::find($mId);
        $Inbox->status  =  1;
        $Inbox->save();
        return response()->json(['success'=>'Record is successfully Updated']); 
    }
}
