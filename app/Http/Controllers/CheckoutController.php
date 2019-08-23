<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Auth;
use App\Order;
use App\Address;

class CheckoutController extends Controller
{
    public function index(){
        return view('cart.checkout',[
            'data' => Cart::content()
          ]);
    }
    public function placeOrder(Request $request){

        $this->validate($request, [
            'fullname' => 'required|min:5|max:35',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'city' => 'required|min:5|max:25',
            'state' => 'required|min:5|max:25',
            'country' => 'required',
            'fullAddress' => 'required'
            ]);

        $address = new Address;
       
        $address->userid = Auth::user()->id;
        $address->fullname = $request->fullname;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->fullAddress = $request->fullAddress;
        $address->save();


        orders::createOrder();

        Cart::destroy();
        return redirect('thankyou');
    }
}
