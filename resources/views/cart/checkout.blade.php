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
          <div>
          <input type="hidden" value="{{csrf_token()}}" name="_token"/>
          <h3>BILLING & SHIPPING</h3>
          <section>
            <legend>Fill billing address</legend>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="input-lg form-control" placeholder="Full name" id="fullname" name="fullname">
              </div>
              <div class="form-group">
                <input type="email"  class="input-lg form-control" placeholder="Email" id="email" name="email"
                  value=" @if (Auth::check()){{Auth::user()->email}}@endif">
              </div>
              <div class="form-group">
                <input type="text"  class="input-lg form-control" placeholder="Phone number" id="phone" name="phone">
              </div>
              <div class="form-group">
                <input type="text"  class="input-lg form-control" placeholder="City name" id="city" name="city">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <!-- Last name -->
                <input type="text"  class="input-lg form-control" placeholder="State" id="state" name="state">
              </div>
              <div class="form-group">
                <input type="text"  class="input-lg form-control" placeholder="Country" id="country" name="country">
              </div>
              <div class="form-group">
                <textarea  class="input-lg form-control" rows="5" id="fullAddress" placeholder="Full Address"
                  name="fullAddress"></textarea>
              </div>
            </div>
          </section>
          <h3>ORDER REVIEW</h3>
          <section>
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
          </section>
          <h3>Payment</h3>
          <section>
            <legend>Stripe Payment Gateway</legend>
            <div class='form-row row'>
              <div class='col-xs-12 form-group name_on_card required'>
                <label for="name_on_card" class="control-label">Name on Card</label>
                <input id="name_on_card" name="name_on_card" type="text" class="input-lg form-control name_on_card" autocomplete="name_on_card" placeholder="Enter Card On Name" required>
              </div>
            </div>
            <div class='form-row row'>
              <div class='col-xs-12 form-group card required'>
                <label for="cardNumber" class="control-label">Card Number</label>
                <input id="cardNumber" name="cardNumber" type="tel" class="input-lg form-control cardNumber" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" required>
              </div>
            </div>
            <div class='form-row row'>
              <div class='col-xs-12 col-md-6 form-group cvc required'>
                <label for="cardCVC" class="control-label">Card CVC formatting</label>
                <input id="cardCVC" name="cardCVC" type="tel" class="input-lg form-control cardCVC" autocomplete="off" placeholder="•••" required>
              </div>
              <div class='col-xs-12 col-md-6 form-group expiration required'>
                <label for="cardExpiry" class="control-label">Card expiry formatting</label>
                <input id="cardExpiry" name="cardExpiry" type="tel" class="input-lg form-control cardExpiry" autocomplete="cardExpiry" placeholder="•• / ••" required>
                <input type="hidden" name="cardTotal" value="{{Cart::total()}}">
              </div>
            </div>
          </section>

          <h3>CONFIRMATION</h3>
          <section>
            <legend>Terms and Conditions</legend>
            <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
            <!-- <input type="submit" class="btn check_out btn-block" value="Place order"/> -->
          </section>
        </div>
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
      <script src="{{Config::get('app.url')}}/public/js/jquery.payment.js"></script>


<!-- If you're using Stripe for payments -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

      <link href="{{Config::get('app.url')}}/public/css/jquery.steps.css" rel="stylesheet">
      <script type="text/javascript">
      


jQuery(document).ready(function($){



/* Fancy restrictive input formatting via jQuery.payment library*/
$('input[name=cardNumber]').payment('formatCardNumber');
$('input[name=cardCVC]').payment('formatCardCVC');
$('input[name=cardExpiry').payment('formatCardExpiry');

/* Form validation using Stripe client-side validation helpers */
jQuery.validator.addMethod("cardNumber", function(value, element) {
    return this.optional(element) || Stripe.card.validateCardNumber(value);
}, "Please specify a valid credit card number.");

jQuery.validator.addMethod("cardExpiry", function(value, element) {    
    /* Parsing month/year uses jQuery.payment library */
    value = $.payment.cardExpiryVal(value);
    return this.optional(element) || Stripe.card.validateExpiry(value.month, value.year);
}, "Invalid expiration date.");

jQuery.validator.addMethod("cardCVC", function(value, element) {
    return this.optional(element) || Stripe.card.validateCVC(value);
}, "Invalid CVC.");


        var form = $("#example-advanced-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
              rules: {          
                  fullname:{
                       required:true
                  },
                  email:{
                       required:true
                  },
                  phone:{
                       required:true
                  },
                  city:{
                       required:true
                  },
                  state:{
                       required:true
                  },
                  country:{
                       required:true
                  },
                  fullAddress:{
                       required:true
                  },
                  cardnumber: {
                    required: true,
                    cardNumber: true
                  },
                  cardexpiry: {
                    required: true,
                    cardExpiry: function(element){
                      return $(element).payment('cardExpiryVal');
                    }
                  },
                  cardcvc: {
                   required: true,
                   cardCVC: function(element){
                    return $.payment.cardType($(element).parents('#example-advanced-form').find('.cardNumber').val());
                   } 
                  }
              },      
            messages: {
              fullname: "Full Name Field is required.",
              email: "Email Field is required.",
              phone: "Phone Number Field is required.",
              city: "City Field is required.",
              state: "State Field is required.",
              country: "Country Field is required.",
              fullAddress: "Address Field is required.",      
              cardnumber: {
                required: "Please Enter Card Number.",
                cardNumber: "Please Enter Valid Card Number."
              },
              cardexpiry: {
                required: "Please Enter Card Expiry Details.",
                cardExpiry: "Please Enter Valid Expiry Details."
              },
              cardcvc: {
               required: "Please Enter Card CVC Number.",
                cardCVC: "Please Enter Valid CVC Number."
             }
      
          }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
   
     enableFinishButton: true,


    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex) { 
        if(currentIndex == 3)
        {
           $('#example-advanced-form .actions ul').append('<input type="submit" class="btn check_out" value="Place order"/>');
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
    },
     /* Labels */
    labels: {
       
        finish: "Finish",
        next: "Next",
        previous: "Previous"
    }
});

});

        
        
      </script>
    </div>
  </div>
</div>
@endsection