@extends("admin.admin_app")

@section("content")

<!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                            {{trans('words.settings')}}
                            </h1>
                        </div>
                        <div class="col-sm-5 text-right hidden-xs">
                            <ol class="breadcrumb push-10-t">
                                <li><a href="{{ URL::to('admin/dashboard') }}">{{trans('words.dashboard')}}</a></li>
                                <li><a class="link-effect" href="">{{trans('words.settings')}}</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

                <!-- Page Content -->
                <div class="content content-boxed">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                             
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
                        

                             <!-- Block Tabs Alternative Style -->
                            <div class="block">
                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                                    
                                     <li role="presentation" class="active">
                                        <a href="#general_settings" aria-controls="general_settings" role="tab" data-toggle="tab">{{trans('words.general')}}</a>
                                    </li>                                    

                                    <li role="presentation">
                                        <a href="#smtp_settings" aria-controls="smtp_settings" role="tab" data-toggle="tab">SMTP</a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#social_settings" aria-controls="social_settings" role="tab" data-toggle="tab">{{trans('words.social_login')}}</a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#homepage_settings" aria-controls="homepage_settings" role="tab" data-toggle="tab">{{trans('words.home_page')}}</a>
                                    </li>                                 

                                    <li role="presentation">
                                        <a href="#aboutus_settings" aria-controls="aboutus_settings" role="tab" data-toggle="tab">{{trans('words.about_page')}}</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#contactus_settings" aria-controls="contactus_settings" role="tab" data-toggle="tab">{{trans('words.contact_page')}}</a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#terms_of_service" aria-controls="terms_of_service" role="tab" data-toggle="tab">{{trans('words.terms_of_service')}}</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#privacy_policy" aria-controls="privacy_policy" role="tab" data-toggle="tab">{{trans('words.privacy_policy')}}</a>
                                    </li>
                                   
                                    <li role="presentation">
                                        <a href="#other_Settings" aria-controls="other_Settings" role="tab" data-toggle="tab">{{trans('words.other_settings')}}</a>
                                    </li>
                                     
                                </ul>
                                <div class="block-content tab-content">
 

                                    <div class="col-lg-10 tab-pane active" id="general_settings">
 
                                        {!! Form::open(array('url' => 'admin/settings','class'=>'form-horizontal padding-15','name'=>'account_form','id'=>'account_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                
                
                                        <div class="form-group">
                                            <label for="avatar" class="col-sm-3 control-label">{{trans('words.site_logo')}}</label>
                                            <div class="col-sm-9">
                                                <div class="media">
                                                    <div class="media-left">
                                                        @if($settings->site_logo)
                                                         
                                                            <img src="{{ URL::asset('upload/'.$settings->site_logo) }}" class="header_site_logo" alt="person">
                                                        @endif
                                                                                        
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <input type="file" name="site_logo" class="filestyle">
                                                        <small class="text-muted bold">Size 220x52px</small>
                                                    </div>
                                                </div>
                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="avatar" class="col-sm-3 control-label">{{trans('words.site_favicon')}}</label>
                                            <div class="col-sm-9">
                                                <div class="media">
                                                    <div class="media-left">
                                                        @if($settings->site_favicon)
                                                         
                                                            <img src="{{ URL::asset('upload/'.$settings->site_favicon) }}" class="site_favicon_icon" alt="person">
                                                        @endif
                                                                                        
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <input type="file" name="site_favicon" class="filestyle">
                                                        <small class="text-muted bold">Size 16x16px</small>
                                                    </div>
                                                </div>
                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.site_name')}}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control" value="">
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.site_email')}}</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="site_email" value="{{ $settings->site_email }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.site_description')}}</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" name="site_description" class="form-control" rows="5" placeholder="A few words about site">{{ $settings->site_description }}</textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.default_timezone')}}</label>
                                            <div class="col-sm-9">
                                            <select class="js-select2 form-control" name="time_zone" style="width:100%;">                               
                                                @foreach(generate_timezone_list() as $key=>$tz_data)
                                                <option value="{{$key}}" @if($settings->time_zone==$key) selected @endif>{{$tz_data}}</option>
                                                @endforeach                            
                                            </select>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.site_style')}}</label>
                                            <div class="col-sm-9">
                                                <select class="js-select2 form-control" name="styling" style="width:100%;">                                                                   
                                                    <option value="style-one" @if($settings->styling=="style-one") selected @endif>Style 1</option>
                                                    <option value="style-two" @if($settings->styling=="style-two") selected @endif>Style 2</option>
                                                    <option value="style-three" @if($settings->styling=="style-three") selected @endif>Style 3</option>
                                                    <option value="style-four" @if($settings->styling=="style-four") selected @endif>Style 4</option>
                                                    <option value="style-five" @if($settings->styling=="style-five") selected @endif>Style 5</option>
                                                    <option value="style-six" @if($settings->styling=="style-six") selected @endif>Style 6</option>                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.currency_code')}} 
                                            </label>
                                            <div class="col-sm-9">
                                                <select name="currency_code" id="currency_code" class="js-select2 form-control" style="width:100%;">
                                                    @foreach(getCurrencyList() as $index => $currency_list)
                                                    <option value="{{$index}}" @if($settings->currency_code==$index) selected @endif>{{$index}} - {{$currency_list}}</option>
                                                    @endforeach                                                
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Facebook URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="facebook_url" value="{{ $settings->facebook_url }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Twitter URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="twitter_url" value="{{ $settings->twitter_url }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Instagram URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="instagram_url" value="{{ $settings->instagram_url }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">LinkedIn URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="linkedin_url" value="{{ $settings->linkedin_url }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="avatar" class="col-sm-3 control-label">{{trans('words.footer_logo')}}</label>
                                            <div class="col-sm-9">
                                                <div class="media">
                                                    <div class="media-left">
                                                        @if($settings->site_footer_logo)
                                                         
                                                            <img src="{{ URL::asset('upload/'.$settings->site_footer_logo) }}" class="footer_logo" alt="person">
                                                        @endif
                                                                                        
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <input type="file" name="site_footer_logo" class="filestyle">
                                                        <small class="text-muted bold">Size 220x52px</small>
                                                    </div>
                                                </div>
                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.footer_text')}}</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" name="site_footer_text" class="form-control" rows="5">{{ $settings->site_footer_text }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.site_copyright_text')}}</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" name="site_copyright" class="form-control" rows="5">{{ $settings->site_copyright }}</textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-sm-9 ">
                                                <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                 
                                            </div>
                                        </div>

                                    {!! Form::close() !!} 
                                    </div>

                                    <div class="col-lg-10 tab-pane" id="smtp_settings">

                                              
                                    {!! Form::open(array('url' => 'admin/smtp_settings','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                                            
                                             
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Host</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="smtp_host" value="{{ $settings->smtp_host }}" class="form-control" value="" placeholder="mail.example.com">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Port</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="smtp_port" value="{{ $settings->smtp_port }}" class="form-control" value="" placeholder="465">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="smtp_email" value="{{ $settings->smtp_email }}" class="form-control" value="" placeholder="contact@ouvert-a-proximite.com">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="smtp_password" value="{{ $settings->smtp_password }}" class="form-control" value="" placeholder="****">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Encryption
                                            </label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="smtp_encryption">                          <option value="SSL" @if($settings->smtp_encryption=="SSL") selected @endif>SSL</option>      
                                                    <option value="TLS" @if($settings->smtp_encryption=="TLS") selected @endif>TLS</option>                                                       
                                                </select>
                                            </div>
                                        </div>
                                            
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>

                                    <div class="col-lg-10 tab-pane" id="social_settings">

                                              
                                    {!! Form::open(array('url' => 'admin/social_login_settings','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                                            
                                            <b><i class="fa fa-google"></i> Google Settings</b><br/><br/>

                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Google Login 
                                            </label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="google_login">                                
                                                    <option value="1" @if($settings->google_login=="1") selected @endif>ON</option>
                                                    <option value="0" @if($settings->google_login=="0") selected @endif>OFF</option>   
                                                </select>
                                            </div>
                                        </div>
                 
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Google Client ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="google_client_id" value="{{ $settings->google_client_id }}" class="form-control" value="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Google Secret</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="google_client_secret" value="{{ $settings->google_client_secret }}" class="form-control" value="">
                                                </div>
                                            </div>
                                            <hr>
                                             
                                            <b><i class="fa fa-facebook"></i> Facebook Settings</b><br/><br/>

                                            <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Facebook Login
                                            </label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="facebook_login">                              
                                                    <option value="1" @if($settings->facebook_login=="1") selected @endif>ON</option>
                                                    <option value="0" @if($settings->facebook_login=="0") selected @endif>OFF</option>   
                                                </select>
                                            </div>
                                        </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Facebook App ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="facebook_app_id" value="{{ $settings->facebook_app_id }}" class="form-control" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Facebook Client Secret</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="facebook_client_secret" value="{{ $settings->facebook_client_secret }}" class="form-control" value="">
                                                </div>
                                            </div>
                                             
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>

                                    <div class="col-lg-10 tab-pane" id="homepage_settings">

                                       {!! Form::open(array('url' => 'admin/homepage_settings','class'=>'form-horizontal padding-15','name'=>'layout_settings_form','id'=>'layout_settings_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                
                                         
                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.home_title')}}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="home_title" value="{{ $settings->home_title }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.home_sub_title')}}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="home_sub_title" value="{{ $settings->home_sub_title }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.home_categories')}}</label>
                                            <div class="col-sm-9">
                                                  
                                                  <select class="js-select2 form-select" id="home_categories_ids" name="home_categories_ids[]" style="width: 100%;" data-placeholder="Choose Categories.." multiple>
                                                    
                                                    @foreach(App\Models\Categories::orderby('category_name')->get() as $cat_list)
                                                    <option></option>                                    
                                                    <option value="{{$cat_list->id}}" @if(in_array($cat_list->id, explode(",",$settings->home_categories_ids))) selected @endif>{{$cat_list->category_name}}</option>
                                                    @endforeach
                                                     
                                                  </select>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">{{trans('words.home_sub_categories')}}</label>
                                            <div class="col-sm-9">
                                                  <select class="js-select2 form-select" id="home_sub_categories_ids" name="home_sub_categories_ids[]" style="width: 100%;" data-placeholder="Choose SubCategories.." multiple>
                                                    @foreach(App\Models\SubCategories::orderby('sub_category_name')->get() as $cat_list)
                                                    <option></option>                                    
                                                    <option value="{{$cat_list->id}}" @if(in_array($cat_list->id, explode(",",$settings->home_sub_categories_ids))) selected @endif>{{$cat_list->sub_category_name}}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="avatar" class="col-sm-3 control-label">{{trans('words.home_background')}}</label>
                                            <div class="col-sm-9">
                                                <div class="media">
                                                    <div class="media-left">
                                                        @if($settings->home_bg_image)
                                                         
                                                            <img src="{{ URL::asset('upload/'.$settings->home_bg_image) }}" class="home_slider_bg" alt="bg image">
                                                        @endif
                                                                                        
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <input type="file" name="home_bg_image" class="filestyle">
                                                         <small class="text-muted bold">Size 1400x500px</small>
                                                    </div>
                                                </div>
                            
                                            </div>
                                        </div>
 
                                         
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-sm-9 ">
                                                <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                 
                                            </div>
                                        </div>

                                    {!! Form::close() !!}  
                                    </div>
                                     

                                    <div class="col-lg-10 tab-pane" id="aboutus_settings">

                                              
                                            {!! Form::open(array('url' => 'admin/aboutus_settings','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                
                 
                                           <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="about_title" value="{{ $settings->about_title }}" class="form-control" value="">
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.about_page')}}</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="about_description" class="elm1_editor" rows="5">{{ $settings->about_description }}</textarea>
                                                </div>
                                                 
                                            </div>
                                             
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>

                                    <div class="col-lg-10 tab-pane" id="contactus_settings">

                                              
                                            {!! Form::open(array('url' => 'admin/contactus_settings','class'=>'form-horizontal padding-15','name'=>'contactus_settings_form','id'=>'contactus_settings_form','role'=>'form')) !!}
                
                 
                                           <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact_title" value="{{ $settings->contact_title }}" class="form-control" value="">
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.address')}}</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="contact_address" class="form-control" rows="5">{{ $settings->contact_address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.contact_email')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact_email" value="{{ $settings->contact_email }}" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.contact_number')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact_number" value="{{ $settings->contact_number }}" class="form-control" value="">
                                                </div>
                                            </div>
                                             
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>


                                    <div class="col-lg-10 tab-pane" id="terms_of_service">

                                              
                                            {!! Form::open(array('url' => 'admin/terms_of_service','class'=>'form-horizontal padding-15','name'=>'terms_of_service_form','id'=>'terms_of_service_form','role'=>'form')) !!}
                
                 
                                           <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="terms_of_title" value="{{ $settings->terms_of_title }}" class="form-control" value="">
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.terms_of_service')}} </label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="terms_of_description" class="elm1_editor" rows="5">{{ $settings->terms_of_description }}</textarea>
                                                </div>
                                                 
                                            </div>
                                             
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>

                                    <div class="col-lg-10 tab-pane" id="privacy_policy">

                                              
                                            {!! Form::open(array('url' => 'admin/privacy_policy','class'=>'form-horizontal padding-15','name'=>'privacy_policy_form','id'=>'privacy_policy_form','role'=>'form')) !!}
                
                 
                                           <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="privacy_policy_title" value="{{ $settings->privacy_policy_title }}" class="form-control" value="">
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">{{trans('words.privacy_policy')}} </label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="privacy_policy_description" class="elm1_editor" rows="5">{{ $settings->privacy_policy_description }}</textarea>
                                                </div>
                                                 
                                            </div>
                                             
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>

                                    
                                    <div class="col-lg-10 tab-pane" id="other_Settings">

                                              
                                            {!! Form::open(array('url' => 'admin/headfootupdate','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                
                 
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Header Code</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="site_header_code" class="form-control" rows="5" placeholder="You may want to add some html/css/js code to header. ">{{ $settings->site_header_code }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Footer Code</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="site_footer_code" class="form-control" rows="5" placeholder="You may want to add some html/css/js code to footer. ">{{ $settings->site_footer_code }}</textarea>
                                                </div>
                                            </div>
                                             
                                            <hr>
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary">{{trans('words.save_settings')}} <i class="md md-lock-open"></i></button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>

                                </div>
                            </div>
                            <!-- END Block Tabs Alternative Style -->
                        </div>
                        
                    </div>
                </div>
                <!-- END Page Content -->

                

@endsection

