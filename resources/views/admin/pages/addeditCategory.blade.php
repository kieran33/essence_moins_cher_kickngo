@extends("admin.admin_app")

@section("content")
 
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="{{ URL::asset('admin_assets/js/core/jquery.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="{{ URL::asset('admin_assets/js/simple-iconpicker.min.css') }}" rel='stylesheet' type='text/css' />
 
 

  <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                               {{ isset($cat->id) ? trans('words.edit_category') : trans('words.add_category') }}
                                
                            </h1>
                        </div>
                        <div class="col-sm-5 text-right hidden-xs">
                            <ol class="breadcrumb push-10-t">
                                <li><a href="{{ URL::to('admin/categories') }}">{{trans('words.categories')}}</a></li>
                                <li><a class="link-effect" href="">{{ isset($cat->id) ? trans('words.edit_category') : trans('words.add_category') }}</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
                <!-- Page Content -->
                <div class="content content-boxed">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="block">
                               <div class="block-content block-content-narrow"> 
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                 @if(Session::has('flash_message'))
                                                <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                                                    {{ Session::get('flash_message') }}
                                                </div>
                                @endif
                                {!! Form::open(array('url' => array('admin/categories/addcategory'),'class'=>'form-horizontal padding-15','name'=>'category_form','id'=>'category_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                                    <input type="hidden" name="id" value="{{ isset($cat->id) ? $cat->id : null }}">
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">{{trans('words.category_icon')}}</label>
                                          <div class="col-sm-9">
                                             <input type="text" name="category_icon" id="select_icon_id" value="{{ isset($cat->category_icon) ? $cat->category_icon : null }}" class="form-control"/>
                                             
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">{{trans('words.category_name')}}</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="category_name" value="{{ isset($cat->category_name) ? $cat->category_name : null }}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">{{trans('words.category_slug')}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="category_slug" value="{{ isset($cat->category_slug) ? $cat->category_slug : null }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">{{trans('words.category_image')}}</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="category_image" class="filestyle">
                                            <small class="text-muted bold">Size 300x200px</small>
                                             
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">&nbsp;</label>
                                        <div class="col-sm-9">
                                            @if(isset($cat->id) AND $cat->category_image)
                                             
                                                <img src="{{URL::to('upload/category/'.$cat->category_image)}}" class="add_edit_cat_item" width="100" alt="category">
                                             
                                            @endif       
                                             
                                        </div>
                                    </div>    
                                    
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-sm-9 ">
                                            <button type="submit" class="btn btn-primary">{{trans('words.save')}}</button>
                                             
                                        </div>
                                    </div>
                                    
                                    {!! Form::close() !!} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->    
 
        
@endsection