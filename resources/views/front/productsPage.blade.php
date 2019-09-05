<script type="text/javascript">
	$(document).ready(function(){
      $("#CartMsg").hide();

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
<div class="row top25">
	@if(count($products) == '0')
	 <div class="col-md-12" align="center">

	        <h1 align="center" style="margin:20px">
	          No products found </h1>

	    </div>
	@else	
	    <div id="load-data">
	        @foreach($products as $product)
      			@if($product->stock == 0)
		    			<div class="col-xs-6 col-sm-4">
				    			<div class="itemBox itemBoxoutofstock">
				    				<div class="prod"><a href="{{url('details')}}/{{$product->id}}"><img src="{{ Storage::disk('public')->url('app/public/product/'.$product->pro_img) }}" alt="" /></a></div>
				    				<label><a href="{{url('details')}}/{{$product->id}}">{{ $product->pro_name }}</a></label>
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
			    				<div class="prod"><a href="{{url('details')}}/{{$product->id}}"><img src="{{ Storage::disk('public')->url('app/public/product/'.$product->pro_img) }}" alt="" /></a></div>
				    				<label><a href="{{url('details')}}/{{$product->id}}">{{ $product->pro_name }}</a></label>
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
	    </div>	
	    	
	@endif
</div>
<div class="ajax-load text-center" style="display:none">
<p><img src="{{url('/public/img')}}/loader.gif"></p>
</div>
<script type="text/javascript">
  var page = 1;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          loadMoreData(page);
      }
  });
  function loadMoreData(page){
  	var cat = $("#catID").val();
    var price = $('#priceID').val(); 
    if(price == ""){
    	price = 0;
    }   

    $.ajax({
            url: 'productsCat/?page=' + page,
            method:"get",  
            dataType:"text",  
             data: 'cat_id=' + cat + '&price=' + price,
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
              var parsed = $.parseHTML(data);
                var result = $(parsed).find("#load-data").html();
              console.log(result);
            //console.log(data.html);
              if(data == " "){
                  $('.ajax-load').html("No more records found");
                  return;
              }
              $('.ajax-load').hide();
              $("#load-data").append(result);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
                alert('server not responding...');
          });
  }
</script>