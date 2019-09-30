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
    var pro_stock = $("#pro_stock").val();
    var token = $("#token").val();
    var id = $("#id").val();

    var pro_img = $('input[name=pro_img]')[0].files[0];
    var post_data = new FormData();    
    post_data.append( 'pro_name', pro_name );
    post_data.append( 'pro_code', pro_code );
    post_data.append( 'pro_price', pro_price );
    post_data.append( 'pro_info', pro_info );
    post_data.append( 'pro_stock', pro_stock );
    post_data.append( '_token', token );
    post_data.append( '_method', 'PUT' );
    post_data.append( 'ids', ids ); 
    post_data.append( 'pro_img', pro_img );   
    post_data.append( 'id', id ); 
        var files =$('input[name^=pro_gal_img')[0].files;
    //console.log(files.length);

    for(var i=0;i<files.length;i++){
        post_data.append("pro_gal_img[]", files[i], files[i]['name']);

    }

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
  <div class="container-fluid tm-mt-big tm-mb-big">
    <!-- Start -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mx-auto">
        <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
          <div class="row">
            <div class="col-12">
              <h2 class="tm-block-title d-inline-block">Add Product</h2>
            </div>
          </div>
          <input type="hidden" value="{{$product->id}}" id="id"/>
          <input type="hidden" value="{{csrf_token()}}" id="token"/>
          <div class="row tm-edit-product-row">
            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input type="text" id="pro_name" value="{{$product->pro_name}}" class="form-control"/>
              </div>
              <div class="form-group mb-3">
                <label for="name">Product Price</label>
                <input type="text" id="pro_price" value="{{$product->pro_price}}" class="form-control"/>
              </div>
              <div class="form-group mb-3">
                <label
                  for="description"
                  >Description</label
                  >
                <textarea class="form-control" id="pro_info" rows="3">{{$product->pro_info}}</textarea>
              </div>
              <div class="form-group mb-3">
                <label for="category">Category</label>
                <select id="cat_id" name="cat_id[]" class="form-control" multiple="multiple">
                @foreach($categories as $category)
                <option
                @foreach($product->categories as $productCategory)
                {{ $productCategory->id == $category->id ? 'selected' : '' }}
                @endforeach value="{{ $category->id }}">{{ $category->cat_name }}</option>
                @endforeach                             
                </select>         
              </div>
              <div class="row">
                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="name">SKU</label>
                  <input type="text" id="pro_code" value="{{$product->pro_code}}" class="form-control"/>
                </div>
                <div class="form-group mb-3 col-xs-12 col-sm-6">
                  <label for="name">Units In Stock</label>
                  <input type="number" id="pro_stock" value="{{$product->stock}}" class="form-control"/>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
              <div class="tm-product-img-dummy mx-auto">
                <img src="{{ Storage::disk('public')->url('app/public/product/'.$product->pro_img) }}" id="blah" alt="your image" width="" />  
              </div>
              <div class="footer custom-file mt-3 mb-3" style="text-align:center">
                <input type="file" id="pro_img" name="pro_img" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
              </div>
            </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
              <br>
                    <div class="preview-images-zone">

                <!-- Code Begins -->
                <input style="display:none;" type="file" name="pro_gal_img[]" id="vpb-data-file" onchange="vpb_image_preview(this)" multiple="multiple" />

                <div align="center" style="width:300px;">

                <span class="vpb_browse_file" onclick="document.getElementById('vpb-data-file').click();"></span> <!-- Browse File Button -->
               <!-- <span onClick="vpb_upload_previewed_files();" class="vpb_pagination_button_clicked">Start Upload</span> --> <!-- Upload File Button -->
                </div>
                <div id="vpb-display-preview"></div>
                 <div id="vpb-display-preview1">
                 @foreach($product->productgalery as $productgaler)
                             

                  <div id="gallery_{{ $productgaler->id }}" class="vpb_wrapper">            
                    <img class="vpb_image_style" src="{{Config::get('app.url')}}/public/image/{{ $productgaler->filename }}" title=""><br>
                    <a style="cursor:pointer;padding-top:5px;" onclick="vpb_remove_selecteds('{{ $productgaler->id }}','{{ $productgaler->filename }}', '{{ route("product.galremove", $productgaler->id) }}')">Remove</a>           
                  </div>              
               
               
                @endforeach                         

 </div>
 <script type="text/javascript">
   //Upload Files delete
function vpb_remove_selecteds(id,name,url)
{

  //alert(url);

  var token = $("#token").val();
  

      $.ajax({
      url: url,
      type: 'GET',
      data: "&_token=" + token + "&id=" + id,
      cache: false,
      processData: false,
      contentType: false,
      
      success: function(data)
      {
        console.log(data);
        $('#v-add-'+id).remove();
        $('#gallery_'+id).fadeOut();
      }
    });
}
 </script>
               

                <!-- Code Begins -->
              </div>


            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary2 btn-block text-uppercase" id="btn">Update Product</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END -->
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
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
