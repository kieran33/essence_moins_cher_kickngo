@extends('app')

@section('head_title',trans('words.categories').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

 
<!-- ================================
     Start Breadcrumb Area
================================= -->

<section>   
<div class="container">
    <h2 class="text-center my-5">Les villes qui commence par {{$letter}}</h2> 
    <div class="row">
        @foreach($categoriesLetter as $cat_data)
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-3">
            <a href="{{URL::to('ville/'.$cat_data->category_slug.'/'.$cat_data->id)}}" title="category" style="display: block;">
                <div>
                    @if($cat_data->category_image)
                        <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/'.$cat_data->category_image)}}" alt="category-image" class="lazy" title="category"
                        style="height: 150px; width: 100%; object-fit: cover;">
                    @else
                        <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/default.jpg')}}" alt="category-image" class="lazy" title="category"
                        style="height: 150px; object-fit: cover;">
                    @endif
                </div>
            </a>
            <div class="p-4 border border-secondary border-top-0" style="height: 150px;">
                <div>
                    <h4>{{$cat_data->category_nom_reel}}</h4>
                    <p>{{$cat_data->category_code_postal}}</p>
                </div>                                     
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-12">
        <div class="pagination d-flex justify-content-center mt-5">
            @include('common.pagination', ['paginator' => $categoriesLetter, 'style' => 'width: 200px; border: solid 1px black; background: white; padding: 5px;'] )
        </div>
    </div>
</div>
</section>
@endsection