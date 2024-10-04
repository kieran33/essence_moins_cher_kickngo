@extends('app')

@section('head_title',trans('words.register').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

 
<!-- ================================
     Start Breadcrumb Area
================================= -->
<section class="breadcrumb-area">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content">
            <h2 class="item_sec_title text-white">{{trans('words.register')}}</h2>
            <ul class="bread-list">
                <li><a href="{{URL::to('/')}}">{{trans('words.home')}}</a></li>
                <li>{{trans('words.register')}}</li>
            </ul>
        </div>
    </div>    
</section>
<!-- ================================
     End Breadcrumb Area Area
================================= --> 

 <!-- ================================
     Start Sign Up Area
================================= -->
<section class="contact-area bg-gray section_item_padding">
    <div class="container">
        <div class="col-lg-5 mx-auto p-0">

            @if (count($errors) > 0)
              <div class="alert alert-danger">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
                  <ul style="list-style: none;">
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


             {!! Form::open(array('url' => 'register','class'=>'card mb-0','id'=>'register','role'=>'form')) !!}    
                <div class="card-body">
                     
                     
                    <div class="form-group">
                        <label class="label-text">{{trans('words.first_name')}}</label>
                        <input class="form-control form--control pl-3" type="text" name="first_name" placeholder="{{trans('words.first_name')}}">
                    </div>
                    <div class="form-group">
                        <label class="label-text">{{trans('words.last_name')}}</label>
                        <input class="form-control form--control pl-3" type="text" name="last_name" placeholder="{{trans('words.last_name')}}">
                    </div>
                    <div class="form-group">
                        <label class="label-text">{{trans('words.email')}}</label>
                        <input class="form-control form--control pl-3" type="email" name="email" placeholder="{{trans('words.email')}}">
                    </div>
                    <div class="form-group">
                        <label class="label-text">{{trans('words.password')}}</label>
                        <div class="position-relative">
                            <input class="form-control form--control pl-3 password-field" type="password" name="password" placeholder="{{trans('words.password')}}">
                            <a href="javascript:void(0)" class="position-absolute top-0 right-0 h-100 btn toggle-password" title="toggle show/hide password">
                                <i class="far fa-eye eye-on"></i>
                                <i class="far fa-eye-slash eye-off"></i>
                            </a>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label class="label-text">{{trans('words.confirm_password')}}</label>
                        <div class="position-relative">
                            <input class="form-control form--control pl-3 password-field" type="password" name="password_confirmation" placeholder="{{trans('words.confirm_password')}}">
                            <a href="javascript:void(0)" class="position-absolute top-0 right-0 h-100 btn toggle-password" title="toggle show/hide password">
                                <i class="far fa-eye eye-on"></i>
                                <i class="far fa-eye-slash eye-off"></i>
                            </a>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="privacyCheckbox" checked required>
                            <label class="custom-control-label" for="privacyCheckbox">
                            {{trans('words.by_signing_up')}} <a href="{{ URL::to('politique-confidentialite/') }}" class="btn-link" target="_blank">{{getcong('privacy_policy_title')}}</a> {{trans('words.and')}} <a href="{{ URL::to('conditions-generales/') }}" class="btn-link" target="_blank">{{getcong('terms_of_title')}}</a>.
                            </label>
                        </div>                        
                    </div>
                    <button class="primary_item_btn border-0 w-100" type="submit">{{trans('words.register')}}</button>
                    <p class="mt-3 text-center">{{trans('words.already_have_account')}}  <a href="{{ URL::to('login/') }}" class="btn-link">{{trans('words.login')}}</a></p>
                </div>
            {!! Form::close() !!} 
        </div>
    </div>
</section>
<!-- ================================
     End Sign Up Area
================================= -->

 
@endsection