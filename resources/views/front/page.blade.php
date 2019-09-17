@extends('front.master')
  @section('content')
      <div class="container">
		<div class="wrapper">
			<div class="row">
				<div class="col-sm-12">
					<div class="breadcrumbs">
				        <ul>
				          	<li><a href="#">Home</a></li>
				         	<li><span class="dot">/</span><a href="#">{{ $CmsPage->title }}</a></li>
				        </ul>
	                </div>
                </div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-12">
		    		<h2>{{ $CmsPage->title }}</h2>
		    		<hr>
		    		{!! $CmsPage->description !!}
		    	</div>
	        </div>
		</div>
	</div>
@endsection
