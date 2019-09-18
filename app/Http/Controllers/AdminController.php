<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Order;
use DB;
use App\Address;
use Hash;
use Auth;

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
    public function profile(){
        $id = Auth::user()->id;
        $address = Address::where('userid',$id)->first();
        return view('admin.profile', compact('address'));
    }
    public function updatProfile(Request $request){
        $id = $request->user_id;
        $address = Address::where('userid',$id)->first();
        if(!$address){
        $address = new Address;
        }       
        $address->fullname = $request->name;
        $address->email = Auth::user()->email;
        $address->userid = $request->user_id;
        $address->phone = $request->phoneNumber;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->fullAddress = $request->full_address;
        $address->save();
        $data['success'] = "Profile Details Updated successfully !";
        return $data;

    }
    public function updatPassword(Request $request){
       if (Hash::check($request->password, Auth::user()->password) == false)
        {
            $data['error'] = "Your current password does not matches with the password you provided. Please try again.";
        }else{

              $user = Auth::user();
              $user->password = Hash::make($request->new_password);
              $user->save();
              $data['success'] = "Your password has been updated successfully.";
        }
        return $data;        
      
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
    public function orders(){
      /*$orders = Order::all();
      return view('admin.orders',compact('orders'));*/

      $orders = DB::table('orders')
       ->Select('users.name as username','users.id as userId',
       'orders.id','orders.status','orders.total','orders.created_at')
        ->leftJoin('users', 'users.id', 'orders.user_id')
        ->orderBy('orders.id','DESC')
        ->get();
        return view('admin.orders',compact('orders'));
    }  
    public function orderStatusUpdate(Request $request){
      if(isset($request->order_id) && isset($request->order_status)){
          //save order status
              $Order = Order::find($request->order_id);
              $Order->status = $request->order_status;
              $Order->save();
              $msg = 'Order is '. $request->order_status;
              return response()->json(['success'=>$msg]);
      }
    }
    public function usersData(){
      $data = User::all();
      return view('admin.user.user',compact('data'));
    }
    
}
