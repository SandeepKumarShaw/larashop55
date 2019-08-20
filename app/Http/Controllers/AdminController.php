<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;


class AdminController extends Controller
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
    public function index(){
        return view('admin.index');
    }
    public function user(){
        $data = User::all();
        //$data = array();
        return view('admin.user.users',compact('data'));
    }   
    public function banUser(Request $request){
      //return $request->all();
      $status = $request->status;
      $userID = $request->userID;

      $User = User::find($userID);
      $User->status  =  $status;
      $User->save();
      return response()->json(['success'=>'Record is successfully Updated']);    

    }
    
}
