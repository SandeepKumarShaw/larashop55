@extends('front.master')
  @section('content')
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
				    	<div class="nice-select">
							<span class="current">Shop Categories</span>
							<ul class="list">
							    <li class="option selected">Some option</li>
							    <li class="option">Another option</li>
							    <li class="option">Potato</li>
							</ul>
						</div>
				    </div>
				    <div class="col-xs-6 col-sm-3">
						<select id="selectbox2">
						    <option value="">Price</option>
						    <option value="aye">Aye</option>
						    <option value="eh">Eh</option>
						    <option value="ooh">Ooh</option>
						    <option value="whoop">Whoop</option>
						</select>
				    </div>
			
				<div class="col-sm-6 hidden-xs">
					<div class="row">

						<div class="col-sm-4 pull-right">
							<select id="selectbox3">
							    <option value="">Sort By</option>
							    <option value="aye">Aye</option>
							    <option value="eh">Eh</option>
							    <option value="ooh">Ooh</option>
							    <option value="whoop">Whoop</option>
							</select>
						</div>
						<div class="styleNm">16 style(s)</div>
					</div>	
				</div>
		    </div>
	    	<div class="row top25">
	    	@if(count($products) == '0')
	    	 <div class="col-md-12" align="center">

		            <h1 align="center" style="margin:20px">
		              No products found </h1>

		        </div>
	    	@else	
	    	@foreach($products as $product)
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
	    					<div class="cartIco hidden-xs"><a href="/"></a></div>
	    				</div>
	    			</div>
	    		</div>
	    	@endforeach
	    	@endif
	    	</div>
		</div>
	</div>		
</div>
@endsection
