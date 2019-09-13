<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Auth;
use App\Order;
use App\Address;
//use Stripe\Stripe;
//use Stripe\Charge;
use Stripe;

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

        /*------ stripe payment-------*/
        $cardExpiry = explode("/", $request->cardExpiry);
        $exp_month = $cardExpiry[0];
        $exp_year = $cardExpiry[1];       

        $stripe = Stripe\Stripe::setApiKey('sk_test_K0ThsZWtj2g1AorbBQDcV2h5');
        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->cardNumber,
                    'exp_month' => $exp_month,
                    'exp_year'  => $exp_year,
                    'cvc'       => $request->cardCVC,
                ],
            ]);

dd($token);


            if (!isset($token['id'])) {
                return Redirect::to('strips')->with('Token is not generate correct');
            }
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'USD',
                'amount'   => $request->cardTotal,
                'description' => 'Register Event',
            ]);
            $charge = Charge::create(array(
                'amount' => $request->cardTotal,
                "source" => $token,
                'currency' => 'usd'
            ));
         
             return 'Payment Success';
            } catch (\Exception $ex) {
                return $ex->getMessage();
            }
        /*Order::createOrder();

        Cart::destroy();*/
        return redirect('thankyou');

    }
    public function thankyou(){
        return view('thankyou');
    }
}
