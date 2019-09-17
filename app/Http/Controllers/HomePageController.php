<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomePageController extends Controller
{
   public function index()
    {
        $products = Product::where('stock','>',0)->offset(0)->limit(6)->get();
        return view('front.index',compact('products'));
    }
}
