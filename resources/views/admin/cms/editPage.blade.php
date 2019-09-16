@extends('admin.master')
@section('title', 'Add New Page')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add New Page</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">                                 
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Page Title</label>
                                                <input type="text" class="form-control" placeholder="Page Title" name="title" id="pagetitle">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" class="form-control" placeholder="Slug" name="slug" id="pageslug" value="">
                                            </div>
                                        </div>                                        
                                    </div>                                

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="5" class="form-control" placeholder="Here can be your description" name="description" id="pagedesc"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Page</button>
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
                                              <input class="form-check-input" type="checkbox" value="1" id="publish" id="pagestatus" name="status" >
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
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                  <input type="file" name="featureImg" id="featureimage">
                            </div>
                            <hr>     
                            
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
