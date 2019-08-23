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
			          <a href="{{url('/myaccount')}}"> {{Auth::user()->name}}</a></li>
                <li><span class="dot">/</span>
                  <a href="">Thank You</a>
			        </ul>
                        </div>
                    </div>
         </div>
        

          <div class="row top25 inboxMain text-center" >
            <img src="{{Config::get('app.url')}}/public/img/thank-you-for-shopping-with-us.jpeg" />
         </div>

       

        </div>
    </div>
  </div>
</div>
@endsection
