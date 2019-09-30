@extends('front.master')
  @section('content')
  <script type="text/javascript">
	$(document).ready(function(){
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
		    		<div class="prodthumb">
		    			<ul>
		    				@foreach($product->productgalery as $productgaler)
		    				<li><img src="{{Config::get('app.url')}}/public/image/{{ $productgaler->filename }}" alt=""/></li>
		    				
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
			    		   	<div class="fk-stars"> 
			                    <i class="fa fa-star"></i>
			                    <i class="fa fa-star"></i>
			                    <i class="fa fa-star"></i>
			                    <i class="fa fa-star"></i>
			                    <i class="fa fa-star"></i> 
			                </div>
			                <p>Be the first to review this product : <a >Write a Review</a></p>
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
@endsection

