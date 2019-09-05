<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inbox;
use Auth;
use App\User;
use App\Address;

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
        $userid = Auth::user()->id;
        $address = Address::where('userid',$userid)->get();
        return view('myaccount.index',compact('link','address'));
    }
    public function saveAddress(Request $request){
        $id = $request->user_id;
        //$address = Address::where('userid', '=', $id)->get();

       // $address = Address::where('userid',$userid)->get();

    /*   $this->validate($request, [
            'name' => 'required|min:5|max:35',
            'phoneNumber' => 'required|numeric',
            'email' => 'required|email',
            'city' => 'required|min:5|max:25',
            'state' => 'required|min:5|max:25',
            'country' => 'required',
            'full_address' => 'required'
            ]);*/

       // $address = Address::findOrFail($id)->get('userid', $id);
$address = Address::where('userid',$id)->first();

                //dd($address);

        $address->fullname = $request->name;
        $address->email = $request->email;
        $address->userid = $request->user_id;
        $address->phone = $request->phoneNumber;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->fullAddress = $request->full_address;
        $address->save();



        return redirect()->back();

        //return view('myaccount.index',compact('address'));

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
