<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cart;
class Order extends Model
{
	protected $fillable = ['total'];

	public function orderCols(){
      return $this->belongsToMany(Product::class);
    }
    public  static function createOrder(){

       $user = Auth::user();
       // insert order table data
       $order = $user->orders()->create([
         'total' => Cart::total()
       ]); 

       // place order and insert data to orders_products
       foreach(Cart::content() as $cData){
         $order->orderCols()->attach($cData->id,[
           'total' => $cData->qty * $cData->price,
           'qty' => $cData->qty
         ]);
       }
       Cart::destroy(); // make cart empty
    }
    public function orders_products(){
      return $this->hasMany('App\Order_Product', 'orders_id');
    }
}
