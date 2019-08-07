<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/


Route::get('test', function () {
    return App\Category::with('childs')->where('parent_id',0)->get();
});

Route::view('/', 'front.index');
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

//Frontend Product Display
Route::get('/products/{cat}','FrontController@productByCategory')->name('category.products');
Route::get('search','FrontController@search')->name('products.search');
Route::resource('products','FrontController');

Route::get('/productsCat','FrontController@productsCat');




//User Middleware Start
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard','HomeController@index');

});

//admin middleware start
Route::group(['prefix' => 'admin', 'middleware'=> ['auth' => 'admin']], function () {	
    Route::get('/','AdminController@index');    
    //admin product    
    Route::resource('product','ProductController');
    Route::view('/prod','admin.product.products',[
      'data' => App\Product::all()
    ]);
    //admin category
    Route::resource('category','CategoryController');
    Route::view('/cats','admin.category.category',[
      'data' => App\Category::all()
    ]);    
});
