@extends('admin.master')
@section('title', 'Edit Page')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     <form action="{{ route('pages.update', $cmsPage->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Edit Page</h4>
                                </div>
                                <div class="content">
                                   
                                        <div class="row">                                 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Page Title</label>
                                                    <input type="text" class="form-control" placeholder="Page Title" name="title" id="pagetitle" value="{{ $cmsPage->title }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Slug</label>
                                                    <input type="text" class="form-control" placeholder="Slug" name="slug" id="pageslug" value="{{ $cmsPage->slug }}">
                                                </div>
                                            </div>                                        
                                        </div>                                

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea rows="5" class="form-control" placeholder="Here can be your description" name="description" id="pagedesc">{{ $cmsPage->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Page</button>
                                        <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">                           
                                <div class="content">
                                  <div class="form-group" style="margin-bottom: 23px;">
                                      <div class="form-group pull-left">
                                          <div class="form-check">
                                              <label class="form-check-label">
                                                    @if($cmsPage->status == true)
                                                        <input class="form-check-input" type="checkbox" value="1" id="publish" id="pagestatus" name="status" checked>
                                                   @else
                                                        <input class="form-check-input" type="checkbox" value="1" id="publish" id="pagestatus" name="status">
                                                    @endif
                                                  <span class="form-check-sign"></span>
                                                  Publish
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                </div>                           
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">                              

                                <div class="image">
                                    <div class="tm-product-img-dummy mx-auto">
                                    <img src="{{ Storage::disk('public')->url('app/public/feature/'.$cmsPage->featureImg) }}" id="blah" alt="your image" width="" />  
                                    </div>                                    
                                </div>                                
                                <div class="content">
                                       <input type="file" id="featureimage" name="featureimage" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>                                
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'description' );
</script>
@endsection
