@extends("admin.admin_app")

@section("content")

  <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                {{ isset($plan_info->id) ? trans('words.edit_plan') : trans('words.add_plan') }}
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ URL::to('admin/plan') }}">{{trans('words.plan')}}</a></li>
                    <li><a class="link-effect" href="">{{ isset($plan_info->id) ? trans('words.edit_plan') : trans('words.add_plan') }}</a></li>
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    {!! Form::open(array('url' => array('admin/plan/addedit'),'class'=>'form-horizontal padding-15','name'=>'category_form','id'=>'category_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                        <input type="hidden" name="id" value="{{ isset($plan_info->id) ? $plan_info->id : null }}">
                         
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.plan_name')}}*</label>
                              <div class="col-sm-9">
                                <input type="text" name="plan_name" value="{{ isset($plan_info->plan_name) ? $plan_info->plan_name : null }}" class="form-control">
                            </div>
                        </div>
                          
                         
                        <div class="form-group">
                        <label class="col-sm-3 control-label">{{trans('words.duration')}}*</label>
                        <div class="col-sm-5">
                            <input type="number" name="plan_duration" value="{{ isset($plan_info->plan_duration) ? $plan_info->plan_duration : null }}" class="form-control" placeholder="7">
                        </div>
                        <div class="col-sm-4">
                            <select name="plan_duration_type" class="form-control">
                            <option value="1" @if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='1') selected @endif>Day(s)</option>
                            <option value="30" @if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='30') selected @endif>Month(s)</option>
                            <option value="365" @if(isset($plan_info->plan_duration_type) AND $plan_info->plan_duration_type=='365') selected @endif>Year(s)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{trans('words.price')}}*</label>
                        <div class="col-sm-9">
                        <input type="text" name="plan_price" value="{{ isset($plan_info->plan_price) ? $plan_info->plan_price : null }}" class="form-control" placeholder="9.99">
                        <small id="emailHelp" class="form-text text-muted mb-2">The minimum amount for processing a transaction through Stripe in USD is $0.50. For more info <a href="https://support.chargebee.com/support/solutions/articles/228511-transaction-amount-limit-in-stripe" target="_blank">click here</a></small>
                        </div>
                    </div>
                        <hr>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.listing_limits')}}</label>
                              <div class="col-sm-9">
                                <input type="number" name="plan_listing_limit" value="{{ isset($plan_info->plan_listing_limit) ? $plan_info->plan_listing_limit : null }}" class="form-control" placeholder="30" min="1">
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.featured_listing_allowed')}}</label>
                              <div class="col-sm-9">                                             
                                <input type="checkbox" name="plan_featured_option" value="1" class="" @if(isset($plan_info->plan_featured_option) && $plan_info->plan_featured_option==1) {{ 'checked' }} @endif>
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.business_hours')}}</label>
                              <div class="col-sm-9">                                             
                                <input type="checkbox" name="plan_business_hours_option" value="1" class="" @if(isset($plan_info->plan_business_hours_option) && $plan_info->plan_business_hours_option==1) {{ 'checked' }} @endif>
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.amenities_list')}}</label>
                              <div class="col-sm-9">                                             
                                <input type="checkbox" name="plan_amenities_option" value="1" class="" @if(isset($plan_info->plan_amenities_option) && $plan_info->plan_amenities_option==1) {{ 'checked' }} @endif>
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.gallery_images')}}</label>
                              <div class="col-sm-9">                                             
                                <input type="checkbox" name="plan_gallery_images_option" value="1" class="" @if(isset($plan_info->plan_gallery_images_option) && $plan_info->plan_gallery_images_option==1) {{ 'checked' }} @endif>
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.video')}}</label>
                              <div class="col-sm-9">                                             
                                <input type="checkbox" name="plan_video_option" value="1" class="" @if(isset($plan_info->plan_video_option) && $plan_info->plan_video_option==1) {{ 'checked' }} @endif>
                             </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{trans('words.enquiry_form')}}</label>
                              <div class="col-sm-9">                                             
                                <input type="checkbox" name="plan_enquiry_form" value="1" class="" @if(isset($plan_info->plan_enquiry_form) && $plan_info->plan_enquiry_form==1) {{ 'checked' }} @endif>
                             </div>
                        </div>
                        <hr>    
                        <div class="form-group">
                        <label class="col-sm-3 control-label">{{trans('words.recommended')}}</label>
                        <div class="col-sm-8" style="display: flex;">
                            <div class="radio radio-success form-check-inline" style="margin-right: 15px;">
                                <input type="radio" id="inlineRadio3" style="margin-left: 0;" value="1" name="plan_recommended" @if(isset($plan_info->plan_recommended) && $plan_info->plan_recommended==1) {{ 'checked' }} @endif>
                                <label for="inlineRadio3"> {{trans('words.yes')}} </label>
                            </div>
                            <div class="radio form-check-inline">
                                <input type="radio" id="inlineRadio4" style="margin-left: 0;" value="0" name="plan_recommended" @if(isset($plan_info->plan_recommended) && $plan_info->plan_recommended==0) {{ 'checked' }} @endif {{ isset($plan_info->id) ? '' : 'checked' }}>
                                <label for="inlineRadio4"> {{trans('words.no')}} </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{trans('words.status')}}</label>
                        <div class="col-sm-9">
                                <select class="form-control" name="status">                               
                                    <option value="1" @if(isset($plan_info->status) AND $plan_info->status==1) selected @endif>{{trans('words.active')}}</option>
                                    <option value="0" @if(isset($plan_info->status) AND $plan_info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
                                </select>
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