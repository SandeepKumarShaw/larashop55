@extends('front.master')
  @section('content')
  @include('front.ourJs')
  <script>
$(document).ready(function(){
  //Add to Cart
  $('.add_to_cart').click(function(){
    var id = $(this).data("id");
          $.ajax({
              type:"get",
              data:"id=" + id,
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
  });
});

</script>
<div class="greyBg">
    <div class="container">
		<div class="wrapper">
			<div class="row">
				<div class="col-sm-12">
				<div class="breadcrumbs">
			        <ul>
			    <li><a href="#">Home   </a></li>
			    <li><span class="dot">/</span>
                  @if(count($products)=="0")
                  <b>{{$cat}}</b>
                  @else
                  @if($cat=="All Products")
                  <a href="{{url('products')}}">
                    {{$cat}}</a>
                  @else
                    <a href="{{url('products')}}/{{$cat}}">
                      {{$cat}}</a>
                      @endif
                  @endif
                 </li>
			        </ul>
                </div>
                </div>
		    </div>
		    <h1 class="text-center">{{$cat}}</h1>
		    <div class="row">
		    		<div class="col-xs-6 col-sm-3">
		    			<select id="catID">
							<option value="">Select a Category</option>
			                 @foreach(App\Category::all() as $cList)
			                 <option class="option" value="{{$cList->id}}">{{$cList->cat_name}}</option>
			                 @endforeach
		               </select>
				    </div>
				    <div class="col-xs-6 col-sm-3">
						<select id="priceID">
						    <option value="">Select Price Range</option>
						    <option value="0-99">0-99</option>
						    <option value="100-299">100-299</option>
						    <option value="300-499">300-499</option>
						    <option value="500-999">500-999</option>
						    <option value="1000-3999">1000-3999</option>
						     <option value="4000-9999">4000-9999</option>

						</select>
				    </div>
			
				<div class="col-sm-6 hidden-xs">
					<div class="row">

						<div class="col-sm-4 pull-right">
							<button id="findBtn" class="btn btn-success">Find</button>
						</div>
						<div class="styleNm">16 style(s)</div>
					</div>
				</div>
		    </div>
		              <div class="alert alert-info" id="CartMsg"></div>

		    <div id="productsData">
                <div class="row top25">
		    	@if(count($products) == '0')
		    	 <div class="col-md-12" align="center">

			            <h1 align="center" style="margin:20px">
			              No products found </h1>

			        </div>
		    	@else	
			            @foreach($products as $product)
				    		@if($product->stock == 0)
				    			<div class="col-xs-6 col-sm-4">
						    			<div class="itemBox itemBoxoutofstock">
						    				<div class="prod"><img src="{{ Storage::disk('public')->url('app/public/product/'.$product->pro_img) }}" alt="" /></div>
						    				<label>{{ $product->pro_name }}</label>
						    				<span class="hidden-xs">Code: {{$product->pro_code}}
					              <br>
					              {{ str_limit($product->pro_info, $limit = 50, $end = '') }}
						    				</span>
						    				<div class="addcart">
						    					<div class="price">Rs {{ $product->pro_price }}</div>
						    					<div class="cartIco hidden-xs"><a></a></div>
						    				</div>
						    				<div class="middle">
											    <div class="text"><img src="{{url('/public/img')}}/hiclipart.com-id_bypfn.png" alt="" /></div>
											</div>
					    			</div>
					    		</div>
							@else

			                            <div class="col-xs-6 col-sm-4">
							    			<div class="itemBox">

							    				<div class="prod"><img src="{{ Storage::disk('public')->url('app/public/product/'.$product->pro_img) }}" alt="" /></div>
							    				<label>{{ $product->pro_name }}</label>
							    				<span class="hidden-xs">Code: {{$product->pro_code}}
						              <br>
						              {{ str_limit($product->pro_info, $limit = 50, $end = '') }}
							    				</span>
							    				<div class="addcart">
							    					<div class="price">Rs {{ $product->pro_price }}</div>
							    					<div class="cartIco hidden-xs"><a href="javascript:void(0);" data-id="{{ $product->id}}" class="add_to_cart"></a></div>
							    				</div>							    				
							    			</div>
							    		</div>
							@endif 
				    	@endforeach
		    	@endif
		    	</div>
		    </div>
		</div>
	</div>		
</div>
@endsection

