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
                <a href="{{url('/home')}}"> {{Auth::user()->name}}</a></li>
              </ul>
            </div>
         </div>
        </div>
        <div class="row top25">
            <div class="panel itemBox">
                <div class="panel-header">
                  <h2 align="left">My Account</h2>
                  <hr>
                </div>                
                    
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                   @if (isset($link))
                    <div class="myContent">

                      <ul class="nav nav-tabs">
                        @if($link=="profile")
                        <li class="active"><a href="#profile" data-toggle="tab">profile</a></li>
                        <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                        <li><a href="#changepassword" data-toggle="tab">change Password</a></li>

                        @elseif($link=="myorders")
                        <li ><a href="#profile" data-toggle="tab">profile</a></li>
                        <li class="active"><a href="#myorders" data-toggle="tab">My orders</a></li>
                        <li><a href="#changepassword" data-toggle="tab">change Password</a></li>

                        @elseif($link=="changepassword")
                        <li ><a href="#profile" data-toggle="tab">profile</a></li>
                        <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                        <li class="active"><a href="#changepassword" data-toggle="tab">change Password</a></li>
                        @else
                          <li class="active"><a href="#profile" data-toggle="tab">profile</a></li>
                        <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                        <li><a href="#changepassword" data-toggle="tab">change Password</a></li>
                        @endif
                      </ul>

                    <div class="tab-content">
                      <div id="profile" class="tab-pane fade in active">
                          <h3>Personal Details</h3>
                            <form action="{{url('/saveAddress')}}" method="post">
                              
                                  <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                      <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>

                             
                              <input type="text" name="name" class="form-control"
                               value="{{AUth::user()->name}}" placeholder="Full Name"/>
                              <br>

                            
                               <input type="text" name="email" class="form-control"
                               value="{{AUth::user()->email}}" style="background-color:#efefef" placeholder="email"/>
                               <br>

                                
                                <input type="text" name="city" class="form-control" value="{{ $address[0]->city }}"
                                placeholder="City"/>
                                <br>
                                
                                
                                <input type="text" name="phoneNumber"  class="form-control" value="{{ $address[0]->phone }}"
                                placeholder="Phone Number"/>
                                <br>

                                 <input type="text"  class="form-control" placeholder="State" value="{{ $address[0]->state }}" name="state">
                                <br>
                                <input type="text"  class="form-control" placeholder="Country" value="{{ $address[0]->country }}" name="country">
                                <br>
                                <textarea  class="form-control" rows="4" placeholder="Full Address"
                                name="full_address">{{ $address[0]->fullAddress }}</textarea>
                                <br>
                               <input type="submit" class="btn btn-primary btn-block" value="Update">
                            </form>
                      </div>
                      <div id="myorders" class="tab-pane fade in" style="height:400px; overflow-x:scroll">
                        
                      @foreach(App\Order::where('user_id',Auth::user()->id)->orderBY('created_at','DESC')->get() as $orders)
                            <div class="row">
                            <p class="alert-info col-md-12">{{date('D, d F Y, h:i', strtotime($orders->created_at))}}</p>
                                <div class="col-md-4 col-sm-4 col-xs-4">  
                                    <img src="{{Config::get('app.url')}}/public/img/No_Image_Available.png" width="100px"/>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4"> 
                                <h4 > {{$orders->status}}</h4>
                                  <h5 > $ {{$orders->total}}</h5>
                                </div>
                              <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:10px">
                              <a href="{{url('orderDetails')}}/{{$orders->id}}" class="btn"><i class="fa fa-list"></i> Order Details</a>
                              <br><br>
                              <a href="{{url('trackOrder')}}/{{$orders->id}}" class="btn"><i class="fa fa-map-marker"></i> Track Order</a>
                              </div>
                            </div>
                            <hr>
                      @endforeach
                      </div>
                      <div id="changepassword" class="tab-pane fade in">
                        Change Password
                      </div>
                    </div>

                    </div>
                    @else
                  <div class="myContent">

                    <ul class="nav nav-tabs">

                      <li class="active"><a href="#profile" data-toggle="tab">profile</a></li>
                      <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                      <li><a href="#changepassword" data-toggle="tab">change Password</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="profile" class="tab-pane fade in active">
                          <h3>Personal Details</h3>
                            <form action="{{url('/saveAddress')}}" method="post">
                                  <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                      <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>

                             
                              <input type="text" name="name" class="form-control"
                               value="{{AUth::user()->name}}" placeholder="Full Name"/>
                              <br>

                            
                               <input type="text" name="email" class="form-control"
                               value="{{AUth::user()->email}}"
                               readonly style="background-color:#efefef" placeholder="email"/>
                               <br>

                                
                                <input type="text" name="city" class="form-control" value="{{ $address[0]->city }}"
                                placeholder="City"/>
                                <br>
                                
                                
                                <input type="text" name="phoneNumber"  class="form-control" value="{{ $address[0]->phone }}"
                                placeholder="Phone Number"/>
                                <br>

                                 <input type="text"  class="form-control" placeholder="State" value="{{ $address[0]->state }}" name="state">
                                <br>
                                <input type="text"  class="form-control" placeholder="Country" value="{{ $address[0]->country }}" name="country">
                                <br>
                                <textarea  class="form-control" rows="4" placeholder="Full Address"
                                name="full_address">{{ $address[0]->fullAddress }}</textarea>
                                <br>
                               <input type="submit" class="btn btn-primary btn-block" value="Update">
                            </form>
                      </div>
                      <div id="myorders" class="tab-pane fade in" style="height:400px; overflow-x:scroll">
                        
                      @foreach(App\Order::where('user_id',Auth::user()->id)->orderBY('created_at','DESC')->get() as $orders)
                            <div class="row">
                            <p class="alert-info col-md-12">{{date('D, d F Y, h:i', strtotime($orders->created_at))}}</p>
                                <div class="col-md-4 col-sm-4 col-xs-4">  
                                    <img src="{{Config::get('app.url')}}/public/img/No_Image_Available.png" width="100px"/>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4"> 
                                <h4 > {{$orders->status}}</h4>
                                  <h5 > $ {{$orders->total}}</h5>
                                </div>
                              <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:10px">
                              <a href="{{url('orderDetails')}}/{{$orders->id}}" class="btn"><i class="fa fa-list"></i> Order Details</a>
                              <br><br>
                              <a href="{{url('trackOrder')}}/{{$orders->id}}" class="btn"><i class="fa fa-map-marker"></i> Track Order</a>
                              </div>
                            </div>
                            <hr>
                      @endforeach
                      </div>
                      <div id="changepassword" class="tab-pane fade in">
                        Change Password
                      </div>
                    </div>
                  </div>   
                  @endif               
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection