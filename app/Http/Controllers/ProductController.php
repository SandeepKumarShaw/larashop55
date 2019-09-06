<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.addProduct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),['pro_name' => 'required','pro_code' => 'required','pro_price' => 'required','pro_info' => 'required']);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{

            //image
            $image = $request->file('pro_img');
            $slug = str_slug($request->pro_name);
            if(isset($image)){
                //make unique name image
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if(!Storage::disk('public')->exists('product')){
                    Storage::disk('public')->makeDirectory('product');
                }
             //   $productImage = Image::make($image)->resize(1600,1066)->save($imageName, 90);

                   $productImage = Image::make($image->getRealPath())->resize(1600,1066)->save( storage_path('app/public' . $imageName ), 90 );



                Storage::disk('public')->put('product/'.$imageName,$productImage);
            }else{
                $imageName = "img.jpg";
            }
           

            $ids = $request->ids;
            $conver_cat_id = html_entity_decode($ids);
            $cat_id = json_decode($conver_cat_id, true);


            $product             = new Product();
            $product->pro_name   = $request->pro_name;
            $product->pro_code   = $request->pro_code;
            $product->pro_price  = $request->pro_price;
            $product->pro_info   = $request->pro_info;
            $product->stock   = $request->pro_stock;
            $product->pro_img    = $imageName;
            $product->save();
            $product->categories()->attach($cat_id);

            return response()->json(['success'=>'Record is successfully added']);            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.product.editProduct', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       $validator = Validator::make($request->all(),['pro_name' => 'required','pro_code' => 'required','pro_price' => 'required','pro_info' => 'required']);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{

            $image = $request->file('pro_img');
            $slug = str_slug($request->title);
            if(isset($image)){
                //make unique name image
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if(!storage::disk('public')->exists('product')){
                    storage::disk('public')->makeDirectory('product');
                }
                //Delete Old product Image
                if(storage::disk('public')->exists('product/'.$product->image)){
                    storage::disk('public')->delete('product/'.$product->image);
                }

                $productImage = Image::make($image)->resize(1600,1066)->save($imageName,90);
                Storage::disk('public')->put('product/'.$imageName,$productImage);
            }else{
                $imageName = $product->pro_img;
            }

            $ids = $request->ids;
            $conver_cat_id = html_entity_decode($ids);
            $cat_id = json_decode($conver_cat_id, true);
            $product->pro_name   = $request->pro_name;
            $product->pro_code   = $request->pro_code;
            $product->pro_price  = $request->pro_price;
            $product->pro_info   = $request->pro_info;
            $product->stock   = $request->pro_stock;
            $product->pro_img    = $imageName;
            $product->save();
            $product->categories()->sync($cat_id);


            return response()->json(['success'=>'Record is successfully Updated']);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::findOrFail( $id );


        if(Storage::disk('public')->exists('product/'.$product->pro_img)){
            Storage::disk('public')->delete('product/'.$product->pro_img);
        }


        $product->categories()->detach();
        $product->delete();
        return response()->json(['success'=>'Record is successfully Deleted']);        
        //return redirect()->route('admin.category.index');
    }
    public function prod(){
        $data = Product::all();
        return view('admin.product.products',compact('data'));

    }
}
