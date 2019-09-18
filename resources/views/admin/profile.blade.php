@extends('admin.master')
@section('title', 'Profile')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <div id="perror"></div>
                            <div id="pmessage"></div>
                        <div id="profile" class="tab-pane fade in active">
                            <form action="" method="post" id="profile_update">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="input-lg form-control"
                                                value="{{Auth::user()->name}}" placeholder="Full Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="email" class="input-lg form-control"
                                                value="{{Auth::user()->email}}" disabled style="background-color:#efefef" placeholder="email"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  class="input-lg form-control" placeholder="Country" value="{{ $address->country }}" id="country" name="country">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  class="input-lg form-control" placeholder="State" value="{{ $address->state }}" id="state" name="state">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="city" name="city" class="input-lg form-control" value="{{ $address->city }}"
                                                placeholder="City"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" id="phoneNumber" name="phoneNumber"  class="input-lg form-control" value="{{ $address->phone }}" placeholder="Phone Number"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea  class="input-lg form-control" rows="4" placeholder="Full Address" id="full_address" name="full_address">{{ $address->fullAddress }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right profile_update">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Change Password</h4>
                    </div>
                    <div class="content">
                        <div id="changepassword" class="tab-pane fade in">
                            <div id="error"></div>
                            <div id="message"></div>
                            <form method="POST" action="{{ route('update.password') }}" id="changepassadmin">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="password" name="password" type="password" class="input-lg form-control" placeholder="Old password" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="new_password" name="new_password" type="password" class="input-lg form-control" placeholder="New password" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="password_confirm" name="password_confirm" type="password" class="input-lg form-control" placeholder="Confirm password" required
                                                autofocus>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right profile_update updatepassword">Chnage Password</button>                        
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    //Update Profile
    $('#profile_update').validate({
        rules: {
                name: "required",
                country: "required",
                state: "required",
                city: "required",
                phoneNumber: "required",
                full_address: "required"
        },
        messages: {
                name: "Please Enter Your Name",
                country: "Please Enter Your Country",
                state: "Please Enter Your State",
                city: "Please Enter Your City",
                phoneNumber: "Please Enter Your Phone Number",
                full_address: "Please Enter Your Full Address"
        },
        submitHandler: function (form) { 
            $.ajax({
                type: 'POST',
                url: "{{ route('updatProfile')}}",
                data: $("#profile_update").serializeArray(),                
                success: function (data) {
                     $('#perror').html(data.error).delay(3000).fadeOut(3000);
                     $('#pmessage').html(data.success).delay(3000).fadeOut(3000);
                     $("#profile_update")[0].reset();
                }
            });
        }
    });

    // Change password
    $('#changepassadmin').validate({
        rules: {
                password: "required",
                new_password: "required",
                password_confirm: {
                    equalTo: "#new_password"
                }
        },
        messages: {
                password: " Enter Your Old Password",
                new_password: " Enter Your New Password",
                password_confirm: " Enter Confirm Password Same as Password"
        },
        submitHandler: function (form) {
            $.ajax({
                type: 'POST',
                url: "{{ route('updatPassword')}}",
                data: $("#changepassadmin").serializeArray(),                
                success: function (data) {
                     $('#error').html(data.error).delay(3000).fadeOut(3000);
                     $('#message').html(data.success).delay(3000).fadeOut(3000);
                     $("#changepassadmin")[0].reset();
                }
            });
        }
    });
});
</script>
@endsection