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