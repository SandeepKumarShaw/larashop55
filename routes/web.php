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
/*Route::view('/','front.index',[
  'products' => App\Product::where('stock','>',0)->offset(0)->limit(6)->get()
]);*/


Route::get('/', 'HomePageController@index');

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

//User Middleware Start
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard','HomeController@index');

    Route::get('myaccount/{link?}','HomeController@myaccount');
    Route::post('saveAddress', 'HomeController@saveAddress');
    Route::post('password', 'HomeController@updatePassword')->name('update.password');;


    Route::get('/inbox','HomeController@inbox');
    Route::get('updateInbox', 'HomeController@updateInbox');

    //Checkout Function
    Route::get('checkout', 'CheckoutController@index');
    //placed order
    Route::post('placeOrder', 'CheckoutController@placeOrder');
    Route::get('thankyou', 'CheckoutController@thankyou');

    // users - orders details
    Route::get('orderDetails/{id}',function($id){
      return view('myaccount.order');
    });
    Route::get('trackOrder/{id}',function($id){
      $orderData = App\Order::where('id',$id)->get();
      return view('myaccount.track',['data' => $orderData]);
    });

    Route::resource('review','ProductReviewController');




// Route that handles submission of review - rating/comment
Route::post('details/{id}', array('before'=>'csrf', function($id)
{

    $input = array(
        'comment' => Input::get('comment'),
        'rating'  => Input::get('rating'),
        'user_id'  => Input::get('user_id')

    );
    // instantiate Rating model
    $review = new App\Review;
    // Validate that the user's input corresponds to the rules specified in the review model
    $validator = Validator::make( $input, $review->getCreateRules());
    // If input passes validation - store the review in DB, otherwise return to product page with error message 
    if ($validator->passes()) {
        $review->storeReviewForProduct($id, $input['comment'], $input['rating'], $input['user_id']);
        return Redirect::to('details/'.$id)->with('review_posted',true);
    }
    
    return Redirect::to('details/'.$id)->withErrors($validator)->withInput();
}));





});

//admin middleware start
Route::group(['prefix' => 'admin', 'middleware'=> ['auth' => 'admin']], function () {	
    Route::get('/','AdminController@index'); 

    //admin user
    Route::get('/users','AdminController@user')->name('admin.users');  
    Route::get('/banUser','AdminController@banUser')->name('admin.banUser'); 
    Route::get('/user','AdminController@usersData'); 
    /* Route::view('/user','admin.user.user',[
          'data' => App\User::all()
        ]);  */

    //admin product 
    Route::get('/galremove/{id}','ProductController@galremove')->name('product.galremove');
    Route::get('/prod','ProductController@prod'); 
    Route::resource('product','ProductController');
    /*Route::view('/prod','admin.product.products',[
          'data' => App\Product::all()
        ]);*/

    //admin category
    Route::get('/cats','CategoryController@cats');
    Route::resource('category','CategoryController');
    /*Route::view('/cats','admin.category.category',[
          'data' => App\Category::all()
        ]); */  

    //admin order
    Route::get('/orders','AdminController@orders');
    Route::get('orderStatusUpdate','AdminController@orderStatusUpdate');
    //admin profile
    Route::get('profile','AdminController@profile');
    Route::post('updatProfile','AdminController@updatProfile')->name('updatProfile');
    Route::post('updatPassword','AdminController@updatPassword')->name('updatPassword');
    //admin cms pages
    Route::resource('pages','CmsPageController');

});
Route::get('{page}', 'FrontController@show');

