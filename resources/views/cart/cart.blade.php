         
<script type="text/javascript">
  $(document).ready(function(){   

    @foreach($cart as $carts)
      $('#upcart{{ $carts->id }}').on('change keyup', function(){
        var newqty = $('#upcart{{ $carts->id }}').val();
        var rowID = $('#rowID{{$carts->id}}').val();
            $.ajax({
              type:'get',
              data:'newqty=' + newqty + '&rowID=' + rowID,
              url:'{{url('/cart/update')}}',
              success:function(response){
                $("#CartMsg").show();
                console.log(response);
                $("#CartMsg").html(response.carMsg);
                loadCart();
                       
                setTimeout(function() {
                    $('#CartMsg').fadeOut('fast');
                }, 2000);

                $('.cartCount').html(response.cartCount);

              }
            });
      });
    @endforeach
  });
</script>


           @if(Cart::count()!="0")

      <!-- design of cart page -->
            <div class="row top20 hidden-xs">
              <div class="col-sm-3">
                <div class="blk-box">
                  <div class="blk-boxHd">Shopping Cart</div>
                  <div class="blk-boxTxt hidden-sm">Do you want to look on order?</div>
                  <div class="arrow-down"></div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="wht-box">
                  <div class="wht-boxHd">Billing &amp; Shipping</div>
                  <div class="wht-boxTxt hidden-sm">Where should we send this order?</div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="wht-box">
                  <div class="wht-boxHd">Order Review</div>
                  <div class="wht-boxTxt hidden-sm">How do you want to pay for your order?</div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="wht-box">
                  <div class="wht-boxHd">Confirmation</div>
                  <div class="wht-boxTxt hidden-sm">Confirm your order</div>
                </div>
              </div>
          </div>
        <div class="row">
            <div class="cart">
                <div class="col-sm-12">
                  <h2>Shopping Basket</h2>
                  <div class="row" id="cart">
                      <div class="col-sm-8">
                        @foreach($cart as $carts)
                                       
                          <div class="cart-row">
                              <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 text-center">
                                  <img src="{{ Storage::disk('public')->url('app/public/product/'.$carts->options->image) }}" class="img-responsive pull-left" width="100px" />
                                  <span class="pull-left top20">
                                    <a href="{{url('details')}}/{{$carts->id}}">
                                        <b>{{ucwords($carts->name)}}</b>
                                      </a>
                                    </span>
                                </div>
                                <div class="col-xs-12 col-sm-3 col-md-3">
                                  <input type="hidden" value="{{$carts->rowId}}" id="rowID{{$carts->id}}">
                                  <div class="cart-qty"> <span>Qty : </span>
                                    <input type="number" class="qty-fill" value="{{$carts->qty}}" id="upcart{{ $carts->id }}">
                                  </div>
                                  <a class="cart-remove btn btn-success" >Update</a>
                                      <a href="{{url('cart/remove')}}/{{$carts->rowId}}"
                                         class="cart-remove btn btn-danger">Remove</a>
                                </div>
                                 <div class="col-xs-12 col-sm-3 col-md-3">
                                      <h6>Unit Price</h6>
                                      <p>${{$carts->price}}
                                      </p>

                                      <hr/>
                                      <h6 class="redtext">
                                        Sub Total: {{$carts->subtotal}}
                                        <br>
                                        Total(included Tax): {{$carts->total}}
                                      </h6>
                                    </div>
                              </div>
                          </div>
                        @endforeach
                          <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="chk-coupon">
                              <label>Coupon Code (if any)</label>
                              <div class="input-group">
                                  <input type="text" class="form-control" >
                                  <span class="input-group-btn">
                                  <input type="button" class="btn fld-btn" value="Redeem Coupon" />
                                  </span> 
                              </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>  
                      </div>
                      <div class="col-sm-4">
                          <div class="cart-total">
                              <h4>Total Amount</h4>
                              <table>
                                <tbody>
                                    <tr>
                                      <td>Sub Total</td>
                                      <td>$ {{Cart::subtotal()}}</td>
                                    </tr>
                                    <tr>
                                      <td>Tax (%)</td>
                                      <td>$ {{Cart::tax()}}</td>
                                    </tr>
                                   
                                  
                                    <tr>
                                      <td>Grand Total</td>
                                      <td>$ {{Cart::total()}}</td>
                                    </tr>
                                  </tbody>
                              </table>
                              <input type="submit" class="btn update btn-block  " value="Continue Shopping">
                              <input type="submit" class="btn check_out btn-block" value="Check Out">
                          </div>
                        </div>
                  </div>
                </div>
                <div class="clearfix"></div>
            </div>
          </div>
          @else
            <div class="row">
               <div class="col-md-2 col-md-offset-5 top25">
                <img src="{{Config::get('app.url')}}/public/img/empty-cart-page-doodle.png"
                class="img-response"/>
                <br><br>
                <p style="text-align:center">Nothing in the bag<br><br>
                <a href="{{url('products')}}"
                class="btn btn-fill btn-primary">Continue Shopping</a>
                </p>

              </div>
            </div>
          @endif
      <!-- design of cart page  end -->
    