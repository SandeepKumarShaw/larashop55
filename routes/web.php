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


/*Route::get('/',function(){
    return App\User::with('orders')->get();
});*/
Route::view('/','front.index',[
  //'products' => App\Product::all()
  'products' => App\Product::where('stock','>',0)->offset(0)->limit(6)->get()
]);


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

//Frontend Product Display
Route::get('/products/{cat}','FrontController@productByCategory')->name('category.products');
Route::get('search','FrontController@search')->name('products.search');
Route::resource('products','FrontController');
Route::get('/productsCat','FrontController@productsCat');
Route::get('details/{id}', 'FrontController@details');



//Cart Function
Route::get('cart','CartController@index');
Route::get('cart/add/{id}','CartController@create');
Route::get('cart/remove/{id}','CartController@destroy');
Route::get('cart/update','CartController@update');
Route::get('cart/cartLoad','CartController@cartLoad');

//Checkout Function
Route::get('checkout', 'CheckoutController@index');
Route::post('placeOrder', 'CheckoutController@placeOrder');



//User Middleware Start
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard','HomeController@index');
    Route::get('myaccount/{link?}','HomeController@myaccount');
    Route::get('/inbox','HomeController@inbox');
    Route::get('updateInbox', 'HomeController@updateInbox');



});

//admin middleware start
Route::group(['prefix' => 'admin', 'middleware'=> ['auth' => 'admin']], function () {	
    Route::get('/','AdminController@index'); 
    Route::get('/users','AdminController@user')->name('admin.users');  
    Route::get('/banUser','AdminController@banUser')->name('admin.banUser'); 
    Route::view('/user','admin.user.user',[
      'data' => App\User::all()
    ]);     
  
   
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

