<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;


class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = 'All Products';
        $products = Product::all();
        return view('front.products', compact('products','cat'));
    } 
    public function productByCategory($cat){
        $category = Category::where('cat_name', $cat)->first();
        if ($category) {
            $products = $category->products()->get();
        }else{
            $products = [];
        }       
        return view('front.products', compact('category','products','cat'));

    }
    public function productsCat(Request $request){
        $cat_id = $request->cat_id;
        $priceCount = $request->price;

        if($cat_id!="" && $priceCount!="0"){
            $category = Category::where('id', $cat_id)->first();
            $cat = $category->cat_name;

              $price = explode("-",$request->price);
              $start = $price[0];
              $end = $price[1];
             $products = $category->products()
                           ->whereBetween('pro_price', [$start, $end])                         
                          ->get();       
        }else if($priceCount!="0" && $cat_id == ""){
              $price = explode("-",$request->price);
              $start = $price[0];
              $end = $price[1]; 
              $products = Product::whereBetween('pro_price', [$start, $end])->get();
            

       }else if($cat_id!="" && $priceCount =="0"){
         $category = Category::where('id', $cat_id)->first();
            if ($category) {
                $products = $category->products()->get();
            }else{
                $products = [];
            } 
       }else{
            $products = Product::all();
       }      
        return view('front.productsPage', compact('products')); 
    }
    public function search(Request $request){
        $cat = $request->input('searchData');
        $products = Product::where('pro_name','LIKE', "%$cat%")->get();
        return view('front.products', compact('products','cat'));

    }
    public function details($id){
          $product = Product::find($id);
            if($product){
              return view('front.details',compact('product'));
            }   

    }

}
