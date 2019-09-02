<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Storage;


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
        //$products = Product::offset(0)->limit(3)->get();
                $products = Product::orderBy('created_at','DESC')->limit(3)->get();

                //$products = Product::paginate(3);

        return view('front.products', compact('products','cat'));
    } 
    public function prodAjax(Request $request)
    {
        $last_prod_id = $request->last_prod_id;
        $output = '';
        $products = Product::where('id','<',$last_prod_id)->orderBy('created_at','DESC')->limit(3)->get();
        if ( ! $products->isEmpty() ){

        foreach($products as $product):
            if($product->stock == 0):
              $output .= '<div class="col-xs-6 col-sm-4">
                  <div class="itemBox itemBoxoutofstock">
                    <div class="prod"><a href=' . url('details') . '/' . $product->id . '><img src=' . Storage::disk('public')->url('app/public/product/'.$product->pro_img) . ' alt="" /></a></div>
                    <label><a href=' . url('details') . '/' . $product->id . '>' . $product->pro_name . '</a></label>
                    <span class="hidden-xs">Code: ' . $product->pro_code . '
                          <br>
                          ' . str_limit($product->pro_info, $limit = 50, $end = '') .'
                    </span>
                    <div class="addcart">
                      <div class="price">Rs ' . $product->pro_price . '</div>
                      <div class="cartIco hidden-xs"><a></a></div>
                    </div>
                    <div class="middle">
                      <div class="text"><img src="' . url('/public/img') . '/hiclipart.com-id_bypfn.png" alt="" /></div>
                  </div>
                </div>
              </div>';
          else:
            $output .= '<div class="col-xs-6 col-sm-4">
                <div class="itemBox">
                    <div class="prod"><a href=' . url('details') . '/' . $product->id . '><img src=' . Storage::disk('public')->url('app/public/product/'.$product->pro_img) . ' alt="" /></a></div>
                    <label><a href=' . url('details') . '/' . $product->id . '>' . $product->pro_name . '</a></label>
                    <span class="hidden-xs">Code: ' . $product->pro_code . '
                          <br>
                          ' . str_limit($product->pro_info, $limit = 50, $end = '') .'
                    </span>
                  <div class="addcart">
                    <div class="price">Rs ' . $product->pro_price . '</div>
                    <div class="cartIco hidden-xs"><a href="javascript:void(0);" data-id=' . $product->id . ' class="add_to_cart"></a></div>
                  </div>                          
                </div>
              </div>';              
          endif;           
        endforeach;
          $output .='<div id="loadMore" style="">
                        <a href="javascript:void(0);" class="last_prod_id" data-pid=' . $product->id . ' data-token=' . csrf_token() . '>Load More</a>
                      </div>'; 
          }            

          echo $output;
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
