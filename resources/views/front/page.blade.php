@extends('front.master')
  @section('content')
      <div class="container">
		<div class="wrapper">
			@if(count($CmsPage) > 0 )
			<div class="row">
				<div class="col-sm-12">
					<div class="breadcrumbs">
				        <ul>
				          	<li><a href="#">Home</a></li>
				         	<li><span class="dot">/</span><a href="#">{{ $CmsPage[0]->title }}</a></li>
				        </ul>
	                </div>
                </div>
		    </div>
		    <div class="row">
		    	<div class="col-sm-12">
		    		<h2>{{ $CmsPage[0]->title }}</h2>
		    		<hr>
		    		{!! $CmsPage[0]->description !!}
		    	</div>
	        </div>
	        @endif
		</div>
	</div>
@endsection
