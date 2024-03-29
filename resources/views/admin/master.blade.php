<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>LaraShop55 - @yield('title')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{Config::get('app.url')}}/admin_theme/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{Config::get('app.url')}}/admin_theme/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{Config::get('app.url')}}/admin_theme/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{Config::get('app.url')}}/admin_theme/assets/css/demo.css" rel="stylesheet" />

		<link href="{{Config::get('app.url')}}/node_modules/select2/dist/css/select2.min.css"
		rel="stylesheet"/>

        <link href="{{Config::get('app.url')}}/admin_theme/assets/css/style.css"
        rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{Config::get('app.url')}}/admin_theme/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="{{Config::get('app.url')}}/admin_theme/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="{{Config::get('app.url')}}/admin_theme/assets/js/vasplus_uploader.js" type="text/javascript"></script>

<style>
    .row_head div{ border:1px solid #efefef}
    .row_body, .row_head div{
        padding:10px;
        text-align:center
    
    }
    .row_body{ border-bottom:1px solid #efefef}
    .tm-bg-primary-dark {
    background-color: #fff;
}
.tm-mb-big {
    margin-bottom: 60px;
}

.tm-product-img-dummy {
    max-width: 100%;
    align-items: center;
    justify-content: center;
    color: #fff;
}
.tm-product-img-dummy img {
    height: 300px;
    width: 100%;
   
}
.custom-file {
    position: relative;
    display: inline-block;
    width: 94%;
    height: calc(2.25rem + 2px);
    margin-bottom: 0;
    margin-top: 20px;
}
.tm-block {
    padding: 40px;
    -webkit-box-shadow: 1px 1px 5px 0 #455c71;
    -moz-box-shadow: 1px 1px 5px 0 #455c71;
    box-shadow: 1px 1px 5px 0 #455c71;
    min-height: 350px;
    height: 100%;
    max-height: 450px;
}
.tm-block-h-auto {
    min-height: 1px;
    max-height: none;
    height: auto;
}
input#pro_img {
    border: 2px solid #049F0C;
    font-weight: 600;
    border-radius: 0;
    max-width: 100%;
    margin: 0px 15px 0px;
}
.btn-primary2 {
    color: #fff;
    background-color: #049F0C;
    border: 2px solid #049F0C;
    font-size: 90%;
    font-weight: 600;
}
.btn {
    border-radius: 0;
    padding: 13px 28px;
    transition: all 0.2s ease;
    max-width: 100%;
}
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="{{Config::get('app.url')}}/admin_theme/assets/img/sidebar-5.jpg">


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('/admin')}}" class="simple-text">
                   LaraShop
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{url('/admin')}}">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

				<li>
					<a href="{{url('/admin/profile')}}">
						<i class="pe-7s-user"></i>
						<p>Profile</p>
					</a>
				</li>

				<li>
						<a href="{{url('/admin/product')}}">
								<i class="pe-7s-note"></i>
								<p>Product</p>
						</a>
				</li>

				<li>
					<a href="{{url('/admin/category')}}">
						<i class="pe-7s-notebook"></i>
						<p>Category</p>
					</a>
				</li>

				<li>
					<a href="{{url('/admin/users')}}">
						<i class="pe-7s-users"></i>
						<p>Users</p>
					</a>
                </li>
                
                <li>
					<a href="{{url('/admin/orders')}}">
						<i class="pe-7s-piggy"></i>
						<p>Orders</p>
					</a>
				</li>

               <li class="dropdown submenuparent">
                      <a href="{{url('/admin/pages')}}" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="pe-7s-menu"></i>
                            <p>
                                CMS Page
                                <b class="caret"></b>
                            </p>
                      </a>
                      <ul class="dropdown-menu submenu">
                        <li><a href="{{route('pages.create')}}">Add Page</a></li> 
                        <li><a href="{{route('pages.index')}}">Pages</a></li>                   
                      </ul>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">

                <div class="collapse navbar-collapse">


                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="{{url('/admin')}}/profile">
                               <p>Account</p>
                            </a>
                        </li>                       
                        <li>
                            <a href="{{url('/logout')}}">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        @yield('content')

        <style type="text/css" media="screen">
           ul.dropdown-menu.submenu {
                background-color: #5054bd;
                border-radius: 0px;
                padding: 0px 0px 0px;
                margin: 0 86px 3px;
            }  
            li.dropdown.submenuparent.open a {
                background-color: #eeeeee59;
                border-color: #337ab7;
            } 
            ul.dropdown-menu.submenu a{
                background-color: #5054bd !important;
                border-color: #337ab7;
            }    
             ul.dropdown-menu.submenu a:hover{
                color: #fff;
            }         
        </style>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="{{ url('admin')}}">
                                Home
                            </a>
                        </li>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>
                     <a href="">LaraShop</a>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{Config::get('app.url')}}/admin_theme/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="{{Config::get('app.url')}}/admin_theme/assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{Config::get('app.url')}}/admin_theme/assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="{{Config::get('app.url')}}/admin_theme/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="{{Config::get('app.url')}}/admin_theme/assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
  -->
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{Config::get('app.url')}}/admin_theme/assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{Config::get('app.url')}}/admin_theme/assets/js/demo.js"></script>
	<script src="{{Config::get('app.url')}}/node_modules/select2/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{Config::get('app.url')}}/admin_theme/assets/js/jquery.validate.min.js"></script>


	<script type="text/javascript">
     function loadCategory(){
              $.ajax({
              type: "GET",
              url: "<?php echo url('admin/cats');?>",
              success:function(data){
                $('#category').html(data);
              }
            });
        }
    function loadProduct(){
              $.ajax({
              type: "GET",
              url: "<?php echo url('admin/prod');?>",
              success:function(data){
                $('#products').html(data);
              }
            });
        }
    function loadUser(){
          $.ajax({
          type: "GET",
          url: "<?php echo url('admin/user');?>",
          success:function(data){
            $('#users').html(data);
          }
        });
    }    
	</script>

</html>
