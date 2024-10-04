@extends("admin.admin_app")

@section("content")

  <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                
                            {{trans('words.edit_gateway')}}
                            </h1>
                        </div>
                        <div class="col-sm-5 text-right hidden-xs">
                            <ol class="breadcrumb push-10-t">
                                <li><a href="{{ URL::to('admin/payment_gateway') }}">{{trans('words.payment_gateway')}}</a></li>
                                <li><a class="link-effect" href="">{{trans('words.edit_gateway')}}</a></li>
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



                                {!! Form::open(array('url' => array('admin/payment_gateway/paypal'),'class'=>'form-horizontal padding-15','name'=>'category_form','id'=>'category_form','role'=>'form','enctype' => 'multipart/form-data')) !!}  
                                    <input type="hidden" name="id" value="{{ isset($post_info->id) ? $post_info->id : null }}">
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Title</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="gateway_name" value="{{ isset($post_info->gateway_name) ? $post_info->gateway_name : null }}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Payment Mode</label>
                                        
                                        <div class="col-sm-9">
                                            <select id="basic" name="mode" class="js-select2 form-control">
                                                 
                                                <option value="sandbox" @if($gateway_info->mode=="sandbox") selected @endif>Sandbox</option>
                                                <option value="live" @if($gateway_info->mode=="live") selected @endif>Live</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Paypal Cient ID</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="paypal_client_id" value="{{ isset($gateway_info->paypal_client_id) ? $gateway_info->paypal_client_id : null }}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Paypal Secret</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="paypal_secret" value="{{ isset($gateway_info->paypal_secret) ? $gateway_info->paypal_secret : null }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Payment Mode</label>
                                        
                                        <div class="col-sm-9">
                                                                                             
                                            <select id="status" class="js-select2 form-control" name="status">                               
                                                <option value="1" @if(isset($post_info->status) AND $post_info->status==1) selected @endif>{{trans('words.active')}}</option>
                                                <option value="0" @if(isset($post_info->status) AND $post_info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
                                            </select>    
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-sm-9 ">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                             
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