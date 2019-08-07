<table style="width:100%">
  <tr >
<td colspan="4" align="right"><b>Total:</b> {{App\Category::count()}}</td>
  </tr>
  <tr style="border-bottom:1px solid #ccc;">
    <th style="padding:10px">Category Name</th>

    <th>Update</th>
    <th>Delete</th>
  </tr>
@foreach($data as $category)
  <tr  style="height:50px">
    <td style="padding:10px">{{$category->cat_name}}</td>

    <td><a class="btn btn-sm btn-fill btn-primary"
      href="{{ route('category.edit', $category->id)}}">Edit</td>
    <td class="text-center"><button class="btn btn-sm btn-fill btn-danger" 
        onclick="deleteData({{ $category->id }})" type="submit">Delete</button></td>  

 
  </tr>
@endforeach
                          <input type="hidden" value="{{csrf_token()}}" id="token"/>

</table>
<script type="text/javascript">
  function deleteData(id){
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
                        url: "{{ url('/admin/category') }}" + '/' + id,
                        type : "POST",
                        data : {'_method' : 'DELETE', '_token' :token},
                        success: function(data){
                            swal("Poof! Your Category has been deleted!", {
                            icon: "success",
                            });
                            loadCategory();
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
                swal("Your Category is safe!");
                }
            });
  }

</script>

