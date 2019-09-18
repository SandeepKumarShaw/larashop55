@extends('admin.master')
@section('title', 'Admin')

@section('content')
<script>
$(document).ready(function(){
  //alert("working");
  $("#btn").click(function(){
    var cat_id = $("#cat_id").val();
    var cat_name = $("#cat_name").val();
    var token = $("#token").val();

    $.ajax({
      type: "PUT",
      data: "cat_name=" + cat_name + "&_token=" + token + "&cat_id=" + cat_id,
      url: "{{ route('category.update', $category->id) }}",
      success:function(data){
        console.log(data);
        if(data.success){
          swal("Success!",data.success, "success");
          loadCategory(); 
        }else if(data.errors){
          jQuery.each(data.errors, function(key, value){
              sweetAlert("Oops...",value, "error");         
          });
        }      

      }
    });
  });

  loadCategory()
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
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Category Name</label>
                                      <input type="text" required="required" id="cat_name" value="{{ $category->cat_name }}" class="form-control"/>
                                  </div>
                            </div>
                          </div>
                          @if(count($data) > 0)
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="category">Select Parent Category</label>
                                      <select id="cat_id" name="cat_id" class="form-control cat_id">
                                        <option value="">please select a category</option>
                                        @foreach($data as $Categories)
                                        <option value="{{$Categories->id}}" {{$category->parent_id == $Categories->id  ? 'selected' : ''}}>{{$Categories->cat_name}}</option>
                                        @endforeach                            
                                      </select>
                                  </div>
                            </div>
                          </div>
                          @endif                         
                          <input type="submit" class="btn btn-success btn-fill" value="Update" id="btn"/>
                          <div class="footer"></div>
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
