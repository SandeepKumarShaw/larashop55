@extends('admin.master')
@section('title', 'All Pages')

@section('content')
    <div class="content">
          <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Pages</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($CmsPage as $key=>$page)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $page->title }}</td>
                                                <td>{{ $page->slug }}</td>
                                                <td>
                                                    @if($page->status == true)
                                                        <span class="badge bg-blue">Publish</span>
                                                    @else
                                                        <span class="badge bg-pink">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                <a href="{{ route('pages.show',$page->id)}}" class=""><i class="pe-7s-look"></i></a>

                                                <a href="{{ route('pages.edit',$page->id)}}" class=""><i class="pe-7s-download"></i></a>

                                                <a href="javascript:void(0);" class="" onclick="deletepages('{{ $page->id }}')"><i class="pe-7s-trash"></i></a>

                                                <!-- <button type="button" class="" onclick="deletepages('{{ $page->id }}')"><i class="pe-7s-trash"></i></button> -->
                                                <form id="delete-form-{{ $page->id }}" action="{{ route('pages.destroy', $page->id)}}" method="post" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                </form>
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

     <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
     {!! Toastr::message() !!}
     <script type="text/javascript">
         @if($errors->any())
            @foreach($errors->all() as $error)
              toastr.error('{{ $error}}','Error',{
                closeButton: true,
                progressBar: true
              });
            @endforeach
         @endif
     </script>
     <style type="text/css" media="screen">
        i.pe-7s-look {
            color: green;
            font-size: 30px;
        }   
        i.pe-7s-download{
            color: #00d3ff;
            font-size: 30px;
        }
        i.pe-7s-trash{
            color:red;
            font-size: 30px;
        }
     </style>
     <script type="text/javascript">
    function deletepages(id) {
        alert(id);
        const swalWithBootstrapButtons = Swal.mixin({
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                /*swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )*/
                 event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
                
              } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Cancelled',
                  'Your imaginary file is safe :)',
                  'error'
                )
              }
            })
    }
</script>
@endsection
