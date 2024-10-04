@extends('app')

@section('head_title', getcong('contact_title').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

 
<!-- ================================
     Start Breadcrumb Area
================================= -->
<section class="breadcrumb-area bg-primary">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content">
            <h2 class="item_sec_title text-white">{{getcong('contact_title')}}</h2>
            <ul class="bread-list">
                <li><a href="{{URL::to('/')}}" title="Home">{{trans('words.home')}}</a></li>
                <li>{{getcong('contact_title')}}</li>
            </ul>
        </div>
    </div>    
</section>
<!-- ================================
     End Breadcrumb Area Area
================================= --> 

 <!-- ================================
    Start Contact Area
================================= -->
<section class="contact-area bg-gray section_item_padding">
    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger mb-3">
            
                <ul style="list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('flash_message'))

        <div class="alert alert-success mb-3" role="alert">{{ Session::get('flash_message') }}</div>

        @endif   
        <style>
            .icon-circle, .user-avatar {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 35px;
                height: 35px;
                border-radius: 50%;
                color: #ffffff;
                margin-right: 10px;
            }
            .user-avatar {
                width: 60px;
                height: 60px;
            }
            .list-items li {
                display: flex;
                align-items: center;
            }
        </style>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{trans('words.contact_information')}}</h4>
                        <hr class="border-top-gray">
                        <ul class="list-items mb-4">
                            <li>
                                <span class="icon-circle bg-primary">
                                    <i class="fal fa-envelope"></i> <!-- Icône de téléphone -->
                                </span>
                                <a href="mailto:{{getcong('contact_email')}}" title="phone">{{getcong('contact_email')}}</a>
                            </li>
                        </ul>    
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                 {!! Form::open(array('url' => 'contact_send','class'=>'contact-form card mb-0','id'=>'contact_form','role'=>'form')) !!}    
                    <div class="card-body">
                        <h4 class="card-title">{{trans('words.get_in_touch')}}</h4>
                        <hr class="border-top-gray">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="label-text">{{trans('words.name')}}</label>
                                <input id="name" class="form-control form--control pl-3" type="text" name="name" placeholder="{{trans('words.enter_name')}}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="label-text">{{trans('words.email')}}</label>
                                <input id="email" class="form-control form--control pl-3" type="email" name="email" placeholder="{{trans('words.enter_email')}}" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="label-text">{{trans('words.subject')}}</label>
                                <input id="email" class="form-control form--control pl-3" type="text" name="subject" placeholder="{{trans('words.enter_subject')}}" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="label-text">{{trans('words.message')}}</label>
                                <textarea id="message" class="form-control form--control pl-3" rows="4" name="message" placeholder="{{trans('words.message')}}..."></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="label-text">Calcul de vérification</label>
                                <input id="calculation" class="form-control form--control pl-3" type="text" name="calculation" placeholder="3 + 2 = ?" required>
                            </div>
                        </div>
                        <button id="send-message-btn" class="primary_item_btn border-0" type="submit">{{trans('words.send_message')}}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- ================================
     End Contact Area
================================= -->

 
@endsection