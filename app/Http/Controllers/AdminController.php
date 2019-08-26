<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Order;
use DB;
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
        return view('admin.profile');
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
    
}
