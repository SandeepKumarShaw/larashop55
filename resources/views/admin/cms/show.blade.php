@extends('admin.master')
@section('title', 'Add New Page')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{ $cmsPage->title }} Page</h4>
                            </div>
                            <div class="content">
                                <form>
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
                                                <textarea rows="5" class="form-control" placeholder="Here can be your description" name="description" id="pagedesc">{!! $cmsPage->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="clearfix"></div>
                                </form>
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
                                              status:
                                              <span class="form-check-sign"></span>
                                                @if($cmsPage->status == true)
                                                    <span class="badge bg-blue">Publish</span>
                                                @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
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
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>                          
                            
                        </div>
                    </div>

                </div>

            </div>

        </div>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'description' );
</script>
@endsection
