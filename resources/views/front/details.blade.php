@extends('front.master')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

@section('styles')
  <style type="text/css">

     /* Enhance the look of the textarea expanding animation */
     .animated {
        -webkit-transition: height 0.2s;
        -moz-transition: height 0.2s;
        transition: height 0.2s;
      }

      .stars {
        margin: 20px 0;
        font-size: 24px;
        color: #d17581;
      }

  </style>
@stop
  @section('content')
  <script type="text/javascript">
	$(document).ready(function(){

  $(".scrollTo").on('click', function(e) {
     e.preventDefault();
     var target = $(this).attr('href');
     $('html, body').animate({
       scrollTop: ($(target).offset().top)
     }, 2000);
  });


      $("#CartMsg").hide();

  //Add to Cart
  $('.add_to_cart_details').click(function(){
    var id = $(this).data("id");
    var qty = $(".qty-fill-details").val();
    if(qty > 0){
    	$.ajax({
              type:"get",
              data:"id=" + id + "&qty=" + qty,
              url:"{{ url('/cart/add')}}/" + id,
              success:function(response){
                $("#CartMsg").show();
                console.log(response);
                $("#CartMsg").html(response.carMsg);                      
                setTimeout(function() {
                    $('#CartMsg').fadeOut('fast');
                }, 2000);

                $('.cartCount').html(response.cartCount);

              }
        });

    }else{
    	alert('Please enter valid Quantity!')
    }
  });
});
</script>

      <div class="container">
		<div class="wrapper">
			<div class="row">
				<div class="col-sm-12">
					<div class="breadcrumbs">
				        <ul>
				          	<li><a href="#">Home</a></li>
				          	<li><span class="dot">/</span><a href="#">Products</a></li>
				         	<li><span class="dot">/</span><a href="#">Health Supplements</a></li>
				        </ul>
	                </div>
                </div>
		    </div>
		    <div class="row top20">
		        <div class="alert alert-info" id="CartMsg"></div>
		    	<div class="col-sm-1 col-md-1 col-lg-1 hidden-xs">
		    		<div class="prodthumb item">
		    			<ul id="content-slider" class="content-slider">
		    				@foreach($product->productgalery as $productgaler)
		    				<li><img class="item" src="{{Config::get('app.url')}}/public/image/{{ $productgaler->filename }}" alt=""/></li>
		    				
		    				 @endforeach
		    			</ul>	
		    		</div>
		    	</div>
		    	<div class="col-sm-5 col-md-5 col-lg-5">
		    		<img class="bigpro_img" src="{{ Storage::disk('public')->url('app/public/product/'.$product->pro_img) }}" alt="" />
		    	</div>
		    	<div class="col-sm-6 col-md-6 col-lg-5">
		    		<div class="prodInfo">
		    		   	<h3>{{ $product->pro_name }}</h3>

                 <div class="rating">
                  <p class="pull-right">{{$product->rating_count}} {{ Str::plural('review', $product->rating_count) }}</p>
                  <p>
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $product->rating_cache) ? '' : '-empty'}}"></span>
                    @endfor
                    {{ number_format($product->rating_cache, 1)}} stars
                  </p>
                  @if($product->rating_count == 0)
                  <p>Be the first to review this product : <a href="#reviews-anchor" class="scrollTo">Write a Review</a></p>
                  @endif
              </div>

		                <h2>Rs {{ $product->pro_price }}</h2>
		                <div class="addbag">

		                	@if($product->stock == 0)
		                	    <div class="bagbtn"><a href="/">OUT OF STOCK</a></div>
		                	@else
		                	     <input type="number" value="1" class="qty-fill-details">
		                	    <div class="bagbtn"><a href="javascript:void(0);" data-id="{{ $product->id}}" class="add_to_cart_details">Add to bag</a></div>
		                	@endif
		                	<span class="wishlist"><i class="fa fa-heart"></i></span><hr>
		                			              
		                </div>
		                <div class="share">
		                	<ul class="hidden-xs">
		                		<li ><a href="/" class="fb">Facebook</a></li>
		                		<li ><a href="/" class="tweet">Tweet</a></li>
		                		<li ><a href="/" class="tell">Tell a friend</a></li>
		                	</ul>
		                	<!--this is only for mobile-->
		                	<ul class="hidden-sm hidden-md hidden-lg">
		                		<li ><a href="/" class="fb"><i class="fa fa-facebook"></i></a></li>
		                		<li ><a href="/" class="tweet"><i class="fa fa-twitter"></i></a></li>
		                		<li ><a href="/" class="tell"><i class="fa fa-envelope"></i></a></li>
		                	</ul>	
		                </div>
		    	    </div>
		    	</div>
		    </div>
		</div>
	</div>
	<div class="container-fluid greyBg prodDes">
		<div class="container">
			<h4>Description</h4>
			<p>{{ $product->pro_info }}</p>
		</div>
	</div>

<div class="container">
            <div @if($product->rating_count > 0) class="well" @endif id="reviews-anchor">
              <div class="row">
                <div class="col-md-12">
                  @if(Session::get('errors'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <h5>There were errors while submitting this review:</h5>
                       @foreach($errors->all('<li>:message</li>') as $message)
                          {{$message}}
                       @endforeach
                    </div>
                  @endif
                  @if(Session::has('review_posted'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5>Your review has been posted!</h5>
                    </div>
                  @endif
                  @if(Session::has('review_removed'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5>Your review has been removed!</h5>
                    </div>
                  @endif
                </div>
              </div>
         
              @if (Auth::check() && in_array(Auth::user()->id, $orderStatus['id']) && in_array('delivered', $orderStatus['status']))
              <div class="text-right">
                <a href="javascript:void(0);" id="open-review-box" class="btn btn-success btn-green">Leave a Review</a>
              </div>
              <div class="row" id="post-review-box" style="display:none;">
                <div class="col-md-12">
                  {{Form::open()}}
                  {{Form::hidden('rating', null, array('id'=>'ratings-hidden'))}}
                  {{Form::hidden('user_id', Auth::user()->id, array('id'=>'user-hidden'))}}
                  {{Form::textarea('comment', null, array('rows'=>'5','id'=>'new-review','class'=>'form-control animated','placeholder'=>'Enter your review here...'))}}
                  <div class="text-left">
                    <div class="stars starrr" data-rating="{{Input::old('rating',0)}}"></div>
                    <a href="#" class="btn btn-danger btn-sm" id="close-review-box" style="display:none; margin-right:10px;"> <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                    <button class="btn btn-success btn-sm" type="submit">Save</button>
                  </div>
                {{Form::close()}}
                </div>
              </div>
              @endif
              @foreach($reviews as $review)
              <hr>
                <div class="row">
                  <div class="col-md-12">
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                    @endfor

                    {{ $review->user ? $review->user->name : 'Anonymous'}} <span class="pull-right">{{$review->timeago}}</span> 
                    
                    <p>{{{$review->comment}}}</p>
                  </div>
                </div>
              @endforeach
              {{ $reviews->links() }}
            </div>


  
</div>


<script>
$(document).ready(function(){
    $(".prodthumb img").click(function(){
    	var images = $(this).attr('src');
        // Change src attribute of image
        $('.bigpro_img').attr("src", images);
    });
     $(".bigpro_img").imagezoomsl();
    
});
</script>
<style type="text/css" media="screen">

    span.glyphicon.glyphicon-star {
    color: #222;
    font-size: 20px;
}
.glyphicon-star-empty{
font-size: 20px;
}
.stars.starrr {
    margin: 0 0 10px;
}
</style>
  
  <script src="{{Config::get('app.url')}}/public/js/expanding.js"></script>
  <script src="{{Config::get('app.url')}}/public/js/starrr.js"></script>

  <script type="text/javascript">
    $(function(){

      // initialize the autosize plugin on the review text area
      $('#new-review').autosize({append: "\n"});

      var reviewBox = $('#post-review-box');
      var newReview = $('#new-review');
      var openReviewBtn = $('#open-review-box');
      var closeReviewBtn = $('#close-review-box');
      var ratingsField = $('#ratings-hidden');

      openReviewBtn.click(function(e)
      {
        reviewBox.slideDown(400, function()
          {
            $('#new-review').trigger('autosize.resize');
            newReview.focus();
          });
        openReviewBtn.fadeOut(100);
        closeReviewBtn.show();
      });

      closeReviewBtn.click(function(e)
      {
        e.preventDefault();
        reviewBox.slideUp(300, function()
          {
            newReview.focus();
            openReviewBtn.fadeIn(200);
          });
        closeReviewBtn.hide();
        
      });

      // If there were validation errors we need to open the comment form programmatically 
      @if($errors->first('comment') || $errors->first('rating'))
        openReviewBtn.click();
      @endif

      // Bind the change event for the star rating - store the rating value in a hidden field
      $('.starrr').on('starrr:change', function(e, value){
        ratingsField.val(value);
      });
    });
  </script>

@endsection

