@extends('app')

@section('head_title',trans('words.dashboard').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

 
<!-- ================================
     Start Breadcrumb Area
================================= -->
<section class="breadcrumb-area">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content">
            <h2 class="item_sec_title text-white">{{trans('words.dashboard')}}</h2>
            <ul class="bread-list">
                <li><a href="{{URL::to('/')}}">{{trans('words.home')}}</a></li>
                <li>{{trans('words.dashboard')}}</li>
            </ul>
        </div>
    </div>    
</section>
<!-- ================================
     End Breadcrumb Area Area
================================= --> 

<!-- ================================
    Start Dashboard Area
================================= -->
<section class="dashboard-area bg-gray section_item_padding">
    <div class="container">

            @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                        {{ Session::get('flash_message') }}
                    </div>
            @endif

            @if(Session::has('error_flash_message'))
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                        {{ Session::get('error_flash_message') }}
                    </div>
            @endif
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">               
               <div class="profile-block card card-body">
                 <div class="img-profile">
                      @if(Auth::user()->image_icon)
                        <img alt="User Photo" src="{{URL::to('upload/members/'.Auth::user()->image_icon)}}" class="img-rounded" alt="profile_img" title="profile pic">
                      @else
                        <img src="{{URL::to('assets/images/avatar.jpg')}}" class="img-rounded" alt="profile_img" title="profile pic">
                      @endif   
                </div>
                   <div class="profile-title-item">
                      <h5>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</h5>
                      <span>{{Auth::user()->email}}</span>
                      
                      <a href="{{URL::to('profile')}}" class="primary_item_btn mb-2 mr-1">{{trans('words.edit_profile')}}</a>
                    </div>
                    <p class="text-muted text-center">Membre depuis {{ Auth::user()->created_at->format('d/m/Y') }}</p>
               </div>
            </div>
        </div>
    </div>
</section>
<!-- ================================
     End Dashboard Area
================================= --> 
@endsection