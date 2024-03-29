<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LaraShop 55</title>
<link type="text/css" href="{{Config::get('app.url')}}/theme/css/bootstrap.css" rel="stylesheet"/>
<link type="text/css" href="{{Config::get('app.url')}}/theme/css/font-awesome.css" rel="stylesheet" />
<link type="text/css" href="{{Config::get('app.url')}}/theme/css/style.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/jquery-1.11.3.js"></script>

</head>
<body>
<header id="header" class="hidden-xs">
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-sm-6"><div class="tollNum">Tollfree : 888 888 8888</div></div>
        <div class="col-sm-6">

          <div class="account-link ">

            <ul>
              @if(Auth::check())
              <li><a href="{{url('/inbox')}}" >INBOX(0)</a></li>
              <li><a href="{{url('/home')}}">MY ACCOUNT</a></li>
              <li><a href="{{url('/logout')}}">LOGOUT</a></li>
              @else
              <li><a href="{{url('/login')}}">LOGIN</a></li>
              @endif
              <li><a onclick="javascript:showDiv('slidingDiv');"
                 href="javascript:;">SEARCH</a>
                <div id="slidingDiv" class="srchBox">
                  <form action="{{route('products.search')}}" method="get">
                   <input type="text" name="searchData" />
                        <i class="fa fa-search"></i>
                      </form>
                    </div>
              </li>

            </ul>
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-2">
          <div class="logo">
            <a href="{{url('/')}}" class="logo-container"><img src="{{Config::get('app.url')}}/theme/images/logo.jpg" /></a></div></div>
        <div class="col-sm-8">
        <div class="nav-link">
          <ul>
            <li><a href="{{url('/products')}}">Products</a>
              <ul class="dropdown">
                 <?php /*@foreach(App\Category::all() as $item)
                   @if($item->count()>0)
                   <li>
                     <a href="{{url('products')}}/{{$item->cat_name}}"><h4>{{$item->cat_name}}</h3></a>
                  
                   </li>
                   @else
                   <li>
                    <a href="{{url('products')}}/{{$item->cat_name}}">
                      <h4>{{$item->cat_name}}</h4></a>
                   </li>
                   @endif
                 @endforeach*/ ?>

                 @foreach(App\Category::with('childs')
                 ->where('parent_id',0)->get() as $item)
                   @if($item->childs->count() > 0)
                      <li>
                        <a href="{{url('products')}}/{{$item->cat_name}}"><h4>{{$item->cat_name}}</h4></a>
                      </li>
                      @foreach($item->childs as $subMenu)
                        <ul>
                          <li><a href="{{url('products')}}/{{$subMenu->cat_name}}">---{{$subMenu->cat_name}}</a></li>
                        </ul>
                      @endforeach
                   @else
                      <li>
                        <a href="{{url('products')}}/{{$item->cat_name}}"><h4>{{$item->cat_name}}</h4></a>
                      </li>
                   @endif
                 @endforeach
                </ul>
            </li>

          </ul>
        </div>
        </div>
        <div class="col-sm-2">
        <div class="nav-btns">
          <div class="nav-cart">
            <a href="{{url('cart')}}">
              <img src="{{Config::get('app.url')}}/theme/images/cart.png"/>
               CART(<span class="cartCount">{{ Cart::count() }}</span>)
           </a>
          </div>
        </div>
        </div>
    </div>
  </div>
</header>
<header id="header" class=" hidden-sm hidden-md hidden-lg">
  <div class="nav-toggle"><div class="icon-menu"> <span class="line line-1"></span> <span class="line line-2"></span> <span class="line line-3"></span> </div></div>
  <div class="logo"><a href="index.php"><img src="{{Config::get('app.url')}}/theme/images/logo.jpg" alt=""  /></a></div>
  <div class="m-cart">
    <div class="nav-btns">
      <div class="nav-cart">
        <img src="{{Config::get('app.url')}}/theme/images/cart.png"/>
        <span>0</span>
      </div>
    </div>
  </div>
  <div class="nav-container">
    <div class="mob-srch">
           <input type="text" placeholder="Search here..." />
        </div>
    <div>
        <ul class="topnav">

            <li><a href="#">Products</a>
                <ul>
                <li><a href="#">Suspendisse semper</a></li>
                        <li><a href="#">lorem gravida</a></li>
                        <li><a href="#">Vestibulum</a></li>
                        <li><a href="#">Tincidunt </a></li>
            </ul>
            </li>


        </ul>
          <div class="mob-nav">
            <ul>
              <li><a href="theme/business-enquiry.php"> <i class="fa fa-th"></i> Bulk Buying</a></li>
                    <li><a href="theme/faq.php"><i class="fa fa-question-circle"></i> Faq's</a></li>
                    <li><a href="theme/testimonials.php"><i class="fa fa-users"></i> Testimonials</a></li>
                    <li><a href="theme/shipping-policy.php"><i class="fa fa-paper-plane"></i> Shipping Policy</a></li>
                    <li><a href="theme/return-policy.php"><i class="fa fa-refresh"></i> Return Policy</a></li>
                <div class="clearfix"></div>
            </ul>
          </div>
        </div>
  </div>
  <div class="clearfix"></div>
</header>
  @yield('content')

<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-3 col-lg-3 hidden-xs">
          <h5>More Info</h5>
          <div class="ft-link">
            <ul>
              <li><a href="theme/business-enquiry.php">Bulk Buying</a></li>
              <li><a href="theme/faq.php">Faq's</a></li>
              <li><a href="theme/testimonials.php">Testimonials</a></li>
              <li><a href="theme/shipping-policy.php">Shipping Policy</a></li>
              <li><a href="theme/return-policy.php">Return Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3 hidden-xs">
           <h5>Resources</h5>
           <div class="ft-link">
            <ul>
              <li><a href="theme/ayurvedic-doshas.php">Ayurvedic Doshas</a></li>
              <li><a href="theme/gluten-allergy.php">Gluten Allergy</a></li>
              <li><a href="theme/ayurvedic-diet.php">Ayurvedic Diet</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-5 col-lg-4">
          <h5>Newsletter</h5>
          <div class="newsletter">
            <p>Sign up for email to get the latest updates &amp; more.</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="enter your email...">
              <span class="input-group-btn">
                <input type="submit" class="btn btn-default" type="button" Value="Subscribe" />
              </span>
            </div>
            <ul class="social">
              <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#" class="youtube"><i class="fa fa-play"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="copyrt">
          &copy; 2017 LaraShop55. All Rights Reserved. <a href="terms-conditions.php">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
  </div>
</footer>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/html5.js"></script>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/bootstrap.js"></script>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/multiple-accordion.js"></script>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/jquery.nice-select.js"></script>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/jquery.bootstrap-responsive-tabs.js"></script>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/zoomsl.js"></script>
  <script src="{{Config::get('app.url')}}/public/js/expanding.js"></script>
  <script src="{{Config::get('app.url')}}/public/js/starrr.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="{{Config::get('app.url')}}/theme/js/details.js"></script>

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
<script>
$(function() {
    var html = $('html, body'),
        navContainer = $('.nav-container'),
        navToggle = $('.nav-toggle'),
        navDropdownToggle = $('.has-dropdown');
    // Nav toggle
    navToggle.on('click', function(e) {
        var $this = $(this);
        e.preventDefault();
        $this.toggleClass('is-active');
        navContainer.toggleClass('is-visible');
        html.toggleClass('nav-open');
    });
});
</script>
<script language="JavaScript">
  $(document).ready(function() {
    $(".topnav").accordion({
      accordion:false,
      speed: 500,
      closedSign: '+',
      openedSign: '-'
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
  
      $('select').niceSelect();
    //  FastClick.attach(document.body);
    });
</script>
<script>
$('.responsive-tabs').responsiveTabs({
  accordionOn: ['xs', 'sm']
});
</script>
<script type="text/javascript">
  function showDiv(divname){
    closealldivs(divname);
    $("#"+divname).slideToggle();
  }
  function closeMe(trgt)
  {
   $("#slidingDiv"+trgt).toggle();
  }
  function closealldivs(divname){
    for(var i=1; i<=3; i++){
      var abc="slidingDiv"+i;
      if(divname!=abc){
     $("#slidingDiv"+i).hide(); }
  }}
</script>
<script type="text/javascript">
  $('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>

</body>
</html>
