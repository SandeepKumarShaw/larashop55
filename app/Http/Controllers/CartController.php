<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use App\Order;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::content();
        return view('cart.index', compact('cart'));
    }
    public function cartLoad()
    {
        $cart = Cart::content();
        return view('cart.cart', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $Product = Product::find($id);
        $qty = $request->qty;

        if($qty){
          $quantity = $qty;
        }else{
          $quantity = 1; 
        }
        Cart::add(['id' => $Product->id, 'name' => $Product->pro_name, 'qty' => $quantity, 'price' => $Product->pro_price,'options' => ['image' => $Product->pro_img]]);

        $data['cartCount'] = Cart::count();
        $data['carMsg'] = "Cart Added successfully";
        return $data;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $qty = $request->newqty;
        $rowId = $request->rowID;

        Cart::update($rowId, $qty);
        $data['cartCount'] = Cart::count();
        $data['carMsg'] = "Cart updated successfully";
        return $data;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back();

    }
/*    public function checkout(){
        Order::createOrder();
        return back();

    }*/
}
