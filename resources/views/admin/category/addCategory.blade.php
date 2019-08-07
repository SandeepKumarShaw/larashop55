@extends('admin.master')
@section('title', 'Admin')

@section('content')
<script>
$(document).ready(function(){
  //alert("working");
  $("#btn").click(function(){
   // $("#msg").show();

    var cat_name = $("#cat_name").val();

    var token = $("#token").val();

    $.ajax({
      type: "post",
      data: "cat_name=" + cat_name + "&_token=" + token,
      url: "{{ route('category.store') }}",
      success:function(data){
        if(data.success){
          swal("Success!",data.success, "success");
          $("#cat_name").val('');
           loadCategory();
        }else if(data.errors){
          jQuery.each(data.errors, function(key, value){
              sweetAlert("Oops...",value, "error");         
          });
        }      

      }
    });
  });
  loadCategory();
});
</script>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">

                            <div class="content">
                            <h2>Add Category</h2>

                          <input type="hidden" value="{{csrf_token()}}" id="token"/>
                              <label>Category Name</label>
                              <input type="text" required="required" id="cat_name" class="form-control"/>
                              <br>


                                <input type="submit" class="btn btn-success btn-fill" value="Submit" id="btn"/>


                              <div class="footer">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card">

                            <div class="content" id="category">
                          <img src="{{url('public/img/loading.gif')}}"
                                  style="width:100%; text-align:center">
                                <div class="footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


@endsection
