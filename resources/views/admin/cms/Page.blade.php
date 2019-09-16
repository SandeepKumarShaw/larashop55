@extends('admin.master')
@section('title', 'All Pages')

@section('content')
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
@endsection
