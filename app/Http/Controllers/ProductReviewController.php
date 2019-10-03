<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $input = array(
        'comment' => Input::get('comment'),
        'rating'  => Input::get('rating'),
        'user_id'  => Input::get('user_id')

    );
    // instantiate Rating model
    $review = new Review;
    // Validate that the user's input corresponds to the rules specified in the review model
    $validator = Validator::make( $input, $review->getCreateRules());
    // If input passes validation - store the review in DB, otherwise return to product page with error message 
    if ($validator->passes()) {
        $review->storeReviewForProduct($id, $input['comment'], $input['rating']);
        return Redirect::to('details/'.$id)->with('review_posted',true);
    }
    
    return Redirect::to('details/'.$id)->withErrors($validator)->withInput();
    }


}
