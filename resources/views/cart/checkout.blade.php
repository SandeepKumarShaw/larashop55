@extends('front.master')
  @section('content')

  <div class="greyBg">
      <div class="container">
  		<div class="wrapper">
        <div class="row">
  				<div class="col-sm-12">
  				 <div class="breadcrumbs">
  			       <ul>
  			          <li><a href="{{url('/')}}">Home </a></li>
                   <li><span class="dot">/</span>
                    <a href="">checkout</a>
  			        </ul>
              </div>
           </div>
  		    </div>
  
<div class="row ">
 @if(Cart::count()!="0")
 <form id="example-advanced-form" action="{{url('/placeOrder')}}" method="post">
<input type="hidden" value="{{csrf_token()}}" name="_token"/>
    <h3>BILLING & SHIPPING</h3>
    <fieldset>
        <legend>Fill billing address</legend>
          <div class="form-group">
        <div class="col-md-6">
            <!-- First name -->
            <input type="text" class="form-control" placeholder="Full name" id="fullname" name="fullname" 
            value=" @if(Auth::check()){{Auth::user()->name}}@endif">
            <span style="color:red">{{ $errors->first('fullname') }}</span>
            <br>  <br>
            <input type="email"  class="form-control" placeholder="Email" id="email" name="email"
            value=" @if (Auth::check()){{Auth::user()->email}}@endif">
            <span style="color:red">{{ $errors->first('email') }}</span>
            <br>  <br>
            <input type="text"  class="form-control" placeholder="Phone number" id="phone" name="phone">
            <span style="color:red">{{ $errors->first('phone') }}</span>
            <br>  <br>
            <input type="text"  class="form-control" placeholder="City name" id="city" name="city">
            <span style="color:red">{{ $errors->first('city') }}</span>
        </div>
        <div class="col-md-6">
            <!-- Last name -->
            <input type="text"  class="form-control" placeholder="State" id="state" name="state">
            <span style="color:red">{{ $errors->first('state') }}</span>
            <br>  <br>
            <input type="text"  class="form-control" placeholder="Country" id="country" name="country">
            <span style="color:red">{{ $errors->first('country') }}</span>
            <br>  <br>
            <textarea  class="form-control" rows="5" id="fullAddress" placeholder="Full Address"
             name="fullAddress"></textarea>
             <span style="color:red">{{ $errors->first('fullAddress') }}</span>
        </div>

       
    </div>        
    </fieldset>
 
    <h3>ORDER REVIEW</h3>
    <fieldset>
        <legend>Shopping Basket</legend>
                                <div class="row">
                            <div class="col-sm-8">
                              @if(isset($msg))
                              <div class="alert alert-info">{{$msg}}</div>
                              
                              @endif
                             

                            @foreach($data as $pro)

                              <div class="cart-row">
                                  <div class="row">

                                    <div class="col-xs-12 col-sm-6 col-md-6 text-center">
                                     <img src="{{ Storage::disk('public')->url('app/public/product/'.$pro->options->image) }}" class="img-responsive pull-left" width="100px" />
                                      <span class="pull-left top20">
                                      <a href="{{url('details')}}/{{$pro->id}}">
                                          <b>{{ucwords($pro->name)}}</b>
                                        </a>
                                      </span>

                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                      <input type="hidden" value="{{$pro->rowId}}"
                                       id="rowID{{$pro->id}}"/>
                                    <div class="cart-qty"> <span>Qty : </span>
                                    {{$pro->qty}}
                                      </div>
                                      <a class="cart-remove btn btn-success" >Update</a>
                                      <a href="{{url('cart/remove')}}/{{$pro->rowId}}"
                                         class="cart-remove btn btn-danger">Remove</a>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                      <h6>Unit Price</h6>
                                      <p>${{$pro->price}}
                                      </p>

                                      <hr/>
                                      <h6 class="redtext">
                                        Sub Total: {{$pro->subtotal}}
                                        <br>
                                        Total(included Tax): {{$pro->total}}
                                      </h6>
                                    </div>
                                  </div>
                              </div>
                              @endforeach

                              
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
                                
                                </div>
                              </div>
                        </div>       
    </fieldset>
 
    <h3>Payment</h3>
    <fieldset>
        <legend>You are to young</legend>
 
        <p>Please go away ;-)</p>
    </fieldset>
 
    <h3>CONFIRMATION</h3>
    <fieldset>
        <legend>Terms and Conditions</legend> 
        <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
        <input type="submit" class="btn check_out btn-block" value="Place order"/>
    </fieldset>
</form>
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
  </div>

    <script src="{{Config::get('app.url')}}/public/js/jquery.validate.min.js"></script>
    <script src="{{Config::get('app.url')}}/public/js/jquery.steps.js"></script>
    <link href="{{Config::get('app.url')}}/public/css/jquery.steps.css" rel="stylesheet">


<script type="text/javascript">
  
var form = $("#example-advanced-form").show();
 
form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
        if (newIndex === 3 && Number($("#age-2").val()) < 18)
        {
            return false;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex)
    {
        // Used to skip the "Warning" step if the user is old enough.
        if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
        {
            form.steps("next");
        }
        // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
        if (currentIndex === 2 && priorIndex === 3)
        {
            form.steps("previous");
        }
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
}).validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password-2"
        }
    }
});


</script>
</div>
</div>
</div>
@endsection
