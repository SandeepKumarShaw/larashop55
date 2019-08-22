@extends('front.master')

@section('content')
<script type="text/javascript">
  $(document).ready(function(){
        
        
    $("#CartMsg").hide();
    loadCart();

  });
    function loadCart(){
        $.ajax({
          type: "GET",
          url: "<?php echo url('cart/cartLoad');?>",
          success:function(data){
            $('#cartLoad').html(data);
          }
        });
    }
</script>

<div class="greyBg">
  <div class="container">
      <div class="wrapper">
        <div class="row">
          <div class="col-sm-12">
           <div class="breadcrumbs">
               <ul>
                  <li><a href="{{url('/')}}">Home </a></li>
                   <li><span class="dot">/</span>
                    <a href="">cart</a>
                </ul>
              </div>
           </div>
          </div>
         
          <div class="alert alert-info" id="CartMsg"></div>

     <div id="cartLoad"></div>

    </div>
  </div>
</div>

@endsection