<table style="width:100%" class="table table-hover table-striped" >

@foreach($data as $product)
  <tr  style="height:50px">
    <td style="padding:10px">{{$product->pro_name}}</td>
    <td style="padding:10px">{{$product->pro_code}}</td>
      <td style="padding:10px">@foreach($product->categories as $category)
	                  <span class="label bg-cyan">{{ $category->cat_name }}</span>
	                  @endforeach</td>
    <td style="padding:10px">{{$product->pro_price}}</td>
    <td><a class="btn btn-sm btn-fill btn-primary" href="{{route('product.edit', $product->id)}}">Edit</td>
      <td class="text-center"><button class="btn btn-sm btn-fill btn-danger" 
        onclick="deleteProduct({{ $product->id }})" type="submit">Delete</button></td>
  </tr>
@endforeach
<input type="hidden" value="{{csrf_token()}}" id="token"/>

</table>
<style>
	span.label.bg-cyan {
    background-color: #00BCD4 !important;
    color: #fff;
}
</style>
<script type="text/javascript">
  function deleteProduct(id){
      var csrf_token=$('meta[name="csrf_token"]').attr('content');
      var token = $("#token").val();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('/admin/product') }}" + '/' + id,
                        type : "POST",
                        data : {'_method' : 'DELETE', '_token' :token},
                        success: function(data){
                            swal("Poof! Your Product has been deleted!", {
                            icon: "success",
                            });
                            loadProduct();
                        },
                        error : function(data){
                            swal({
                                title: 'Opps...',
                                text : data.responseJSON.message,
                                type : 'error',
                                timer : '3000'
                            })
                        }
                    })
                } else {
                swal("Your Product is safe!");
                }
            });
  }

</script>