@extends('admin.master')
@section('title', 'Admin')

@section('content')

<script>
$(document).ready(function(){
  $("#btn").click(function(){
    var cat_id = $("#cat_id").val();
    var ids = [];
        $('#cat_id :selected').each(function(i, selected){
                ids[i] = $(selected).val();
        });

    var pro_name = $("#pro_name").val();
    var pro_code = $("#pro_code").val();
    var pro_price = $("#pro_price").val();
    var pro_info = $("#pro_info").val();
    var pro_stock = $("#pro_stock").val();
    var token = $("#token").val();
    //alert(cat_id);
    var ids = JSON.stringify(ids);

    var pro_img = $('input[name=pro_img]')[0].files[0];
    var post_data = new FormData();    
    post_data.append( 'pro_name', pro_name );
    post_data.append( 'pro_code', pro_code );
    post_data.append( 'pro_price', pro_price );
    post_data.append( 'pro_info', pro_info );
    post_data.append( 'pro_stock', pro_stock );
    post_data.append( '_token', token );
    post_data.append( 'ids', ids ); 
    post_data.append( 'pro_img', pro_img );   


    $.ajax({
      type: "post",
      data: post_data,
      url: "{{ route('product.store') }}",
      processData: false,
      contentType: false,
      success:function(data){
         



        if(data.success){
          swal("Success!",data.success, "success");
          $("#pro_name").val('');
          $("#pro_code").val('');
          $("#pro_price").val('');
          $("#pro_info").val('');
          $("#pro_stock").val('');
          //$("#cat_id").select2('val', '')

          $('select#cat_id').select2({
                allowClear: true,
                minimumResultsForSearch: -1,
                width: 600
          });
          $("select#cat_id").val(null).trigger("change");

           loadProduct();
        }else if(data.errors){
         // var obj = jQuery.parseJSON( data );
          var obj = eval(data);
          var dataobj = obj.errors;
          var str = dataobj.toString();
          var datastr = str.split(',').join("\r\n");
         // console.log(datastr);
          sweetAlert("Oops...",datastr, "error"); 

      
        }
      }
    });
  });

 loadProduct();
$('#cat_id').select2();


});
</script>
<div class="content">
            <div class="container-fluid">
                <div class="row">


                  <div class="col-md-5">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="card">
                              <div class="content">
                                <h3>Product Image</h3>
                                <img src="{{url('/public/img')}}/img.jpg" id="blah" alt="your image" width="100%" />                           
                                  <div class="footer" style="text-align:center">
                                  <input type="file" id="pro_img" name="pro_img" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                                                  <div class="card">

                            <div class="content">
                            <h2>Add Product</h2>
                          <input type="hidden" value="{{csrf_token()}}" id="token"/>

                          <label>Categories</label>


                          <select id="cat_id" name="cat_id[]" class="form-control" multiple="multiple">
                            <option value="">please select a category</option>
                            @foreach(App\Category::all() as $Categories)
                            <option value="{{$Categories->id}}">{{$Categories->cat_name}}</option>
                            @endforeach
                            
                          </select>
                          <br>
                              <label>Product Name</label>
                              <input type="text" id="pro_name" class="form-control"/>
                              <br>

                              <label>Product Code</label>
                              <input type="text" id="pro_code" class="form-control"/>
                              <br>

                              <label>Product Price</label>
                              <input type="text" id="pro_price" class="form-control"/>
                              <br>

                              <label>Product Stock</label>
                              <input type="number" id="pro_stock" class="form-control"/>
                              <br>

                              <label>Product Info</label>
                              <textarea id="pro_info" class="form-control"></textarea>
                              <br>
                                <input type="submit" class="btn btn-success btn-fill" value="Submit" id="btn"/>


                              <div class="footer">

                                </div>
                            </div>
                        </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="col-md-7">
                        <div class="card">
                          <table width="100%" class="table table-hover table-striped" >
                            <tr >
                          <td colspan="5" align="right"><b>Total:</b> {{App\Product::count()}}</td>
                            </tr>
                            <tr style="border-bottom:1px solid #ccc;">
                              <th style="padding:10px"> Name</th>
                              <th style="padding:10px"> Code</th>
                              <th style="padding:10px">Catgeory</th>
                              <th style="padding:10px">Price</th>
                              <th>Update</th>
                            </tr>
                          </table>
                            <div class="content"
                             style="height:400px; overflow-y:scroll; overflow-x:hidden">

                                <div id="products">
                                  <img src="{{url('public/img/loading.gif')}}"
                                  style="width:100%; text-align:center">
                                </div>

                                <div class="footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>



@endsection
