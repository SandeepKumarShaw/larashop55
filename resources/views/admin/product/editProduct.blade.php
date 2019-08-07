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
    var ids = JSON.stringify(ids);


    var pro_name = $("#pro_name").val();
    var pro_code = $("#pro_code").val();
    var pro_price = $("#pro_price").val();
    var pro_info = $("#pro_info").val();
    var token = $("#token").val();
    var id = $("#id").val();

    var pro_img = $('input[name=pro_img]')[0].files[0];
    var post_data = new FormData();    
    post_data.append( 'pro_name', pro_name );
    post_data.append( 'pro_code', pro_code );
    post_data.append( 'pro_price', pro_price );
    post_data.append( 'pro_info', pro_info );
    post_data.append( '_token', token );
    post_data.append( '_method', 'PUT' );
    post_data.append( 'ids', ids ); 
    post_data.append( 'pro_img', pro_img );   
    post_data.append( 'id', id ); 
    $.ajax({
      type: "POST",
      data: post_data,
      url: "{{ route('product.update', $product->id) }}",
      processData: false,
      contentType: false,
      success:function(data){
        if(data.success){
          swal("Success!",data.success, "success");              

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
                    <div class="col-md-3">
                        <div class="card">

                            <div class="content">
                            <h3>Product Image</h3>
                            <img src="{{ Storage::disk('public')->url('app/public/product/'.$product->pro_img) }}" id="blah" alt="your image" width="100%" />                           
                                <div class="footer" style="text-align:center">
                                <input type="file" id="image" name="pro_img" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">

                            <div class="content">
                              <input type="hidden" value="{{$product->id}}" id="id"/>
                            <input type="hidden" value="{{csrf_token()}}" id="token"/>
                            <label>Categories</label>
                          <select id="cat_id" name="cat_id[]" class="form-control" multiple="multiple">
                                    @foreach($categories as $category)
                                        <option
                                          @foreach($product->categories as $productCategory)
                                           {{ $productCategory->id == $category->id ? 'selected' : '' }}
                                          @endforeach value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                        @endforeach                             
                          </select>
                                <label>Product Name</label>
                                <input type="text" id="pro_name" value="{{$product->pro_name}}" class="form-control"/>
                                <br>

                                <label>Product Code</label>
                                <input type="text" id="pro_code" value="{{$product->pro_code}}" class="form-control"/>
                                <br>

                                <label>Product Price</label>
                                <input type="text" id="pro_price" value="{{$product->pro_price}}" class="form-control"/>
                                <br>

                                <label>Product Info</label>
                                <textarea type="text" id="pro_info"  class="form-control">{{$product->pro_info}}</textarea>
                                <br>
                                  <input type="submit" class="btn btn-success btn-fill" value="Submit" id="btn"/>

                                <div class="footer">
                                <p>Donec congue eleifend sapien, in molestie diam vulputate sit amet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
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
