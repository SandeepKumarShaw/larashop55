<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.category.addCategory', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),['cat_name' => 'required']);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $cat_id = $request->cat_id;
            $parent_id = ($cat_id) ? $cat_id : 0;
            $category        = new Category();
            $category->cat_name  = $request->cat_name;
            $category->parent_id = $parent_id;
            $category->save();
            return response()->json(['success'=>'Record is successfully added']);            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data = Category::all();
        return view('admin.category.editCategory', compact('category', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),['cat_name' => 'required']);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $cat_id = $request->cat_id;
            $parent_id = ($cat_id) ? $cat_id : 0;           
            $category->cat_name  = $request->cat_name;
            $category->parent_id = $parent_id;
            $category->save();
            return response()->json(['success'=>'Record is successfully Updated']);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail( $id );

        $category->delete();
        return response()->json(['success'=>'Record is successfully Deleted']);        
        //return redirect()->route('admin.category.index');
    }
    public function cats(){
        $data = Category::all();
        return view('admin.category.category',compact('data'));

    }
}
