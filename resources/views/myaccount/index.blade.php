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
                  <h2 align="center">My Account</h2>
                  <hr>
                </div>
                <div class="panel-body">
                  <div class="myContent">
                    <ul class="nav nav-tabs">

                      <li class="active"><a href="#profile" data-toggle="tab">profile</a></li>
                      <li><a href="#myorders" data-toggle="tab">My orders</a></li>
                      <li><a href="#changepassword" data-toggle="tab">change Password</a></li>

                    </ul>
                    <div class="tab-content">
                      <div id="profile" class="tab-pane fade in active">
                        profile table
                      </div>
                      <div id="myorders" class="tab-pane fade in">
                        My Orders
                      </div>
                      <div id="changepassword" class="tab-pane fade in">
                        Change Password
                      </div>
                    </div>
                  </div>                  
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection