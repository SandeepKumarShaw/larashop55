<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppWishlist;
use Auth;
class WishlistController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, array(
         'user_id'=>'required',
         'product_id' =>'required',
        ));

        $status=Wishlist::where('user_id',Auth::user()->id)
        ->where('product_id',$request->product_id)
        ->first();

        if(isset($status->user_id) and isset($request->product_id))
           {
               return redirect()->back()->with('flash_messaged', 'This item is already in your 
               wishlist!');
           }
           else
           {
               $wishlist = new Wishlist;

               $wishlist->user_id = $request->user_id;
               $wishlist->product_id = $request->product_id;
               $wishlist->save();

               return redirect()->back()->with('flash_message',
                             'Item, '. $wishlist->product->title.' Added to your wishlist.');
           }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $wishlist = Wishlist::findOrFail($id);
      $wishlist->delete();

      return redirect()->route('wishlist.index')
          ->with('flash_message',
           'Item successfully deleted');
    }
}
