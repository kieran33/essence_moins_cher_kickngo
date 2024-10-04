@extends('app')

@section('content')



<!-- ================================
     Start Hero Wrapper Area
================================= -->


<section class="hero-wrapper-area hero-bg" style="background-image: url({{URL::to('upload/'.getcong('home_bg_image'))}});">
    <div class="overlay"></div>
    <div class="container">
        <div class="hero-heading text-center">
            <h2 class="item_sec_title text-white cd-headline zoom">
                {{getcong('home_title')}}
                <style>
                .category-img {
                    height: 150px; /* Remplacez par la hauteur que vous voulez */
                    object-fit: cover; /* Cela permet de maintenir l'aspect de l'image */
                }
                </style>
                <span class="cd-words-wrapper">
                    <?php $n=1?>
                    @foreach(explode(',',getcong('home_categories_ids')) as $categories_ids)
                    <?php
                    $categories = array(
                        'Boulanger', 'Plombier', 'Charcutier', 'Électricien', 'Coiffeur', 'Infirmier',
                        'Pâtissier', 'Médecin', 'Professeur', 'Cuisinier', 'Policier', 'Avocat',
                        'Designer', 'Architecte', 'Ébéniste', 'Pharmacien', 'Ingénieur', 'Artiste',
                        'Agriculteur', 'Journaliste'
                    );
                    $categorie = $categories[array_rand($categories)];                    
                    ?>
                    @if($n==1)
                    <b class="is-visible">{{$categorie}} à  {{App\Models\Categories::getCategoryInfo($categories_ids)->category_nom_reel}}</b>
                    @else
                        <b>{{$categorie}} à {{App\Models\Categories::getCategoryInfo($categories_ids)->category_nom_reel}}</b>
                    @endif
                    
                     <?php $n++;?>
                    @endforeach
 
                </span>
            </h2>
            <p class="item_sec_desc text-white">{{getcong('home_sub_title')}}</p>
        </div>
        <div class="card">
             
                {!! Form::open(array('url' => 'entreprise/','method'=>'get','class'=>'card-body row pb-1','id'=>'search','role'=>'form')) !!}
                <div class="col-lg-3 pr-lg-0">
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="search_text" placeholder="{{trans('words.search_anything')}}">
                        <span class="fal fa-search form-icon"></span>
                    </div>
                </div>
                {{-- <div class="col-lg-3 pr-lg-0">
                    <div class="form-group">
                        <select class="select-picker" name="location_id" data-width="100%" data-size="5" data-live-search="true">
                            <option value="">{{trans('words.select_location')}}</option>                             
                            @foreach(\App\Models\Location::orderBy('location_name')->get() as $location) 
                            <option value="{{$location->id}}">{{$location->location_name}}</option> 
                            @endforeach                                                     
                        </select>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-3 pr-lg-0">
                    <div class="form-group">
                        <select class="select-picker" name="sub_cat_id" data-width="100%" data-size="5" data-live-search="true">
                            <option value="">{{trans('words.select_subcategory')}}</option>                             
                            @foreach(\App\Models\SubCategories::get() as $subcategory) 
                            <option value="{{$subcategory->id}}">{{$subcategory->sub_category_name}}</option> 
                            @endforeach                                                     
                        </select>
                    </div>
                </div> --}}
                {{-- <div class="form-group">
                        <select class="select-picker" name="cat_id" data-width="100%" data-size="5" data-live-search="true">
                            <option value="">{{trans('words.select_location')}}</option>                             
                            @foreach(\App\Models\Categories::get() as $i => $category)
                            @php
                                $formatted_name = ucwords(str_replace('-', ' ', $category->category_slug));
                            @endphp
                            <option value="{{$category->id}}">{{$formatted_name}}</option>
                        @endforeach                                                   
                        </select>
                    </div> --}}
                    {{-- <div class="col-lg-3 pr-lg-0">
                        <div class="form-group">
                            <input type="text" class="form-control typeahead" placeholder="search..">
                            <span class="fal fa-search form-icon"></span>
                            <input type="hidden" name="sub_cat_id">
                        </div> --}}
                        {{-- <script>
                            var path = "{{ route('autocompleteSubCat') }}";
                            $('input.typeahead-subcat').typeahead({
                                source: function(query, process) {
                                    return $.get(path, { query: query }, function(data) {
                                        return process(data);
                                    });
                                },
                                displayText: function(item) {
                                    return item.sub_category_name;
                                }
                            });
                        </script>
                    </div> --}}
                    <div class="col-lg-3 pr-lg-0">
                        <div class="form-group">
                            <input type="text" class="form-control typeahead" placeholder="search..">
                        </div>
                    </div>
                    <div class="col-lg-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control form--control typeahead-cat" placeholder="Ville ou Code Postale...">
                        <span class="fal fa-search form-icon"></span>
                        <input type="hidden" name="cat_id">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <button class="primary_item_btn border-0 w-100" type="submit">{{trans('words.search')}}</button>
                    </div>
                </div>
                {!! Form::close() !!} 
        </div>        
         
    </div>
</section>
<!-- ================================
     End Hero Wrapper Area
================================= -->

<!-- ================================
     Start Category Area
================================= -->
<section class="category_area bg-gray section_item_padding">
    <div class="container">
        <div class="text-center">
            <h2 class="item_sec_title mb-3">{{trans('words.popular_cat')}}</h2>             
        </div>
        <div class="row mt-5">
            @foreach(explode(',',getcong('home_categories_ids')) as $categories_ids)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <a href="{{URL::to('ville/'.App\Models\Categories::getCategoryInfo($categories_ids)->category_slug.'/'.$categories_ids)}}" class="sec_category_item d-block hover-y" title="category">
                    <div class="overlay"></div>  
                    @if(App\Models\Categories::getCategoryInfo($categories_ids)->category_image)
                        <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/'.App\Models\Categories::getCategoryInfo($categories_ids)->category_image)}}" alt="category-image" class="category-img lazy" title="category">
                    @else
                        <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/default.jpg')}}" alt="category-image" class="category-img lazy" title="category">
                    @endif
                    <div class="category-content d-flex align-items-center justify-content-center">
                        <div class="cat_text_item">
                            <h4 class="cat-title mb-1">{{App\Models\Categories::getCategoryInfo($categories_ids)->category_nom_reel}}</h4>
                            <span class="badge">{{ \App\Models\Categories::countCategoryListings($categories_ids) }} {{trans('words.listings')}}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach             
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-block justify-content-center text-center mt-3">
				<a href="{{URL::to('ville/')}}" class="primary_item_btn mx-auto" title="Categories">{{trans('words.view_all_cat')}}</a>
			</div>
        </div>
    </div>
</section>



 <!-- ================================
     Start Category Area
================================= -->
@if(count($sub_categories_listings) > 0)

{{-- <section class="listing_card_area section_item_padding">
    <div class="container">
        <div class="text-center">
            <h2 class="item_sec_title mb-3">{{trans('words.featured_subcat')}}</h2>
             
        </div>
        <div class="card-carousel owl-carousel owl-theme mt-5">
            @foreach($sub_categories_listings as $subcategories) 
            <div class="card mb-0 hover-y">
                <a href="{{URL::to('entreprise/'.$subcategories->listing_slug.'/'.$subcategories->id)}}" class="card-image" title="{{$subcategories->title}}">
                    <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{ URL::asset('upload/entreprise/'.$subcategories->featured_image.'-s.jpg') }}" class="card-img-top lazy" alt="card image" title="{{$subcategories->title}}">                                 
                </a>
                <div class="card-body position-relative">
                    <div class="d-flex align-items-center mb-1">
                        <h4 class="card-title mb-0"><a href="{{URL::to('entreprise/'.$subcategories->listing_slug.'/'.$subcategories->id)}}" title="{{$subcategories->sub_category_name}}">{{$subcategories->sub_category_name}}</a></h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> --}}

@endif
<!-- ================================
     End Category Area
================================= -->

<!-- ================================
     Essaie de la nouvelle implémentation de ma table pivot -->
{{-- <section class="listing_card_area section_item_padding">
<div class="container">
<div class="card">
    <header class="card-header">
        <p class="card-header-title">Ville</p>
    </header>
    <div class="card-content">
        <div class="content">
            @foreach($categories as $category)
            <p>Ville : {{ $category->category_name }}</p>
            <ul>
                @foreach($category->subcategories as $subcategory)
                <li>{{ $subcategory->sub_category_name }}</li>
                @endforeach
            </ul>
            <hr>
            @endforeach
        </div>
    </div>
</div>
</div>
</section> --}}
@if(count($featured_listings) > 0)

<!-- ================================
     Start Card Area
================================= -->
<section class="listing_card_area section_item_padding">
    <div class="container">
        <div class="text-center">
            <h2 class="item_sec_title mb-3">{{trans('words.featured_listings')}}</h2>
             
        </div>
        <div class="card-carousel owl-carousel owl-theme mt-5">
            @foreach($featured_listings as $listing) 

            <div class="card mb-0 hover-y">
                <a href="{{URL::to('entreprise/'.$listing->listing_slug.'/'.$listing->id)}}" class="card-image" title="{{$listing->title}}">
                    <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{ URL::asset('upload/entreprise/'.$listing->featured_image.'-s.jpg') }}" class="card-img-top lazy" alt="card image" title="{{$listing->title}}">                                 
                    <div class="list-tag-badge"><span class="fal {{\App\Models\Categories::getCategoryInfo($listing->cat_id)->category_icon}} icon-element icon-element-sm"></span> {{\App\Models\Categories::getCategoryInfo($listing->cat_id)->category_name}}</div>
                </a>
                <div class="card-body position-relative">
                    <div class="d-flex align-items-center mb-1">
                        <h4 class="card-title mb-0"><a href="{{URL::to('entreprise/'.$listing->listing_slug.'/'.$listing->id)}}" title="{{$listing->title}}">{{$listing->title}}</a></h4>
                         
                    </div>
                    <p class="card-text"><i class="fal fa-map-marker-alt icon"></i>{{Str::limit($listing->address,50)}}</p>
                     
                </div>
                <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
                    <div class="star-rating" @if($listing->review_avg) data-rating="{{$listing->review_avg}}"@endif>
                        <div class="rating-counter">{{\App\Models\Reviews::getTotalReview($listing->id)}} {{trans('words.reviews')}}</div>
                    </div>                                 
                </div>
            </div>
 
            @endforeach
              
             
        </div>
    </div>
</section>
<!-- ================================
     End Card Area
================================= -->
<section class="sub_category_area bg-gray section_item_padding">
    <div class="container">
        <div class="text-center">
            <h2 class="item_sec_title mb-3">{{trans('words.job+city')}}</h2>             
        </div><br>
<div class="row d-flex align-items-stretch">
    @php
    $randomSubCategories = $sub_cat_list2->random(16);
    @endphp
    @foreach($randomSubCategories as $sub_catdata)
        @php
            $categorySlug = $cat_info->firstWhere('id', $sub_catdata->cat_id)->category_slug;
            $categoryTitle = $cat_info->firstWhere('id', $sub_catdata->cat_id)->category_nom_reel;
        @endphp

    <div class="col-lg-3 d-flex pb-3">
        <a href="{{URL::to('entreprise/'.$categorySlug.'/'.$sub_catdata->sub_category_slug.'/'.$sub_catdata->id)}}" class="card p-2 text-center text-gray hover-y h-100 w-100 d-flex justify-content-center align-items-center" title="{{$sub_catdata->sub_category_name}}"> 
            <span>{{$sub_catdata->sub_category_name}} {{trans('words.at')}}  {{$categoryTitle}}</span>
        </a>
    </div>
    @endforeach
</div>
</div>
</section>
@endif
@endsection 
<!-- ================================
     End Card Area
================================= -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>












































@extends('app')

@section('content')



<!-- ================================
     Start Hero Wrapper Area
================================= -->


<section class="hero-wrapper-area hero-bg" style="background-image: url({{URL::to('upload/'.getcong('home_bg_image'))}});">
    <div class="overlay"></div>
    <div class="container">
        <div class="hero-heading text-center">
            <h2 class="item_sec_title text-white cd-headline zoom">
                {{getcong('home_title')}}
                <style>
                .category-img {
                    height: 150px; /* Remplacez par la hauteur que vous voulez */
                    object-fit: cover; /* Cela permet de maintenir l'aspect de l'image */
                }
                </style>
                <span class="cd-words-wrapper">
                    <?php $n=1?>
                    @foreach(explode(',',getcong('home_categories_ids')) as $categories_ids)
                    <?php
                    $categories = array(
                        'Boulanger', 'Plombier', 'Charcutier', 'Électricien', 'Coiffeur', 'Infirmier',
                        'Pâtissier', 'Médecin', 'Professeur', 'Cuisinier', 'Policier', 'Avocat',
                        'Designer', 'Architecte', 'Ébéniste', 'Pharmacien', 'Ingénieur', 'Artiste',
                        'Agriculteur', 'Journaliste'
                    );
                    $categorie = $categories[array_rand($categories)];                    
                    ?>
                    @if($n==1)
                    <b class="is-visible">{{$categorie}} à  {{App\Models\Categories::getCategoryInfo($categories_ids)->category_nom_reel}}</b>
                 
                        {{-- <b class="is-visible">{{App\Models\Categories::getCategoryInfo($categories_ids)->category_nom_reel}}</b> --}}
                    @else
                        <b>{{$categorie}} à {{App\Models\Categories::getCategoryInfo($categories_ids)->category_nom_reel}}</b>
                    @endif
                    
                     <?php $n++;?>
                    @endforeach
 
                </span>
            </h2>
            <p class="item_sec_desc text-white">{{getcong('home_sub_title')}}</p>
        </div>
        <div class="card">
                {!! Form::open(array('url' => 'entreprise/','method'=>'get','class'=>'card-body row pb-1','id'=>'search','role'=>'form')) !!}
                <div class="col-lg-3 pr-lg-0">
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="search_text" placeholder="{{trans('words.search_anything')}}">
                        <span class="fal fa-search form-icon"></span>
                    </div>
                </div>
                <div class="col-lg-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control typeahead" placeholder="search..">
                    </div>
                </div>
                <div class="col-lg-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control form--control typeahead-cat" placeholder="Ville ou Code Postale...">
                        <span class="fal fa-search form-icon"></span>
                        <input type="hidden" name="cat_id">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <button class="primary_item_btn border-0 w-100" type="submit">{{trans('words.search')}}</button>
                    </div>
                </div>
                {!! Form::close() !!} 
        </div>          
    </div>
</section>
<!-- ================================
     End Hero Wrapper Area
================================= -->

<!-- ================================
     Start Category Area
================================= -->
<section class="category_area bg-gray section_item_padding">
    <div class="container">
        <div class="text-center">
            <h2 class="item_sec_title mb-3">{{trans('words.popular_cat')}}</h2>             
        </div>
        <div class="row mt-5">
            @foreach(explode(',',getcong('home_categories_ids')) as $categories_ids)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <a href="{{URL::to('ville/'.App\Models\Categories::getCategoryInfo($categories_ids)->category_slug.'/'.$categories_ids)}}" class="sec_category_item d-block hover-y" title="category">
                    <div class="overlay"></div>  
                    @if(App\Models\Categories::getCategoryInfo($categories_ids)->category_image)
                        <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/'.App\Models\Categories::getCategoryInfo($categories_ids)->category_image)}}" alt="category-image" class="category-img lazy" title="category">
                    @else
                        <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/default.jpg')}}" alt="category-image" class="category-img lazy" title="category">
                    @endif
                    <div class="category-content d-flex align-items-center justify-content-center">
                        <div class="cat_text_item">
                            <h4 class="cat-title mb-1">{{App\Models\Categories::getCategoryInfo($categories_ids)->category_nom_reel}}</h4>
                            <span class="badge">{{ \App\Models\Categories::countCategoryListings($categories_ids) }} {{trans('words.listings')}}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach             
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-block justify-content-center text-center mt-3">
				<a href="{{URL::to('ville/')}}" class="primary_item_btn mx-auto" title="Categories">{{trans('words.view_all_cat')}}</a>
			</div>
        </div>
    </div>
</section>

@if(count($featured_listings) > 0)

<!-- ================================
     Start Card Area
================================= -->
<section class="listing_card_area section_item_padding">
    <div class="container">
        <div class="text-center">
            <h2 class="item_sec_title mb-3">{{trans('words.featured_listings')}}</h2>
             
        </div>
        <div class="card-carousel owl-carousel owl-theme mt-5">
            @foreach($featured_listings as $listing) 

            <div class="card mb-0 hover-y">
                <a href="{{URL::to('entreprise/'.$listing->listing_slug.'/'.$listing->id)}}" class="card-image" title="{{$listing->title}}">
                    <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{ URL::asset('upload/entreprise/'.$listing->featured_image.'-s.jpg') }}" class="card-img-top lazy" alt="card image" title="{{$listing->title}}">                                 
                    <div class="list-tag-badge"><span class="fal {{\App\Models\Categories::getCategoryInfo($listing->cat_id)->category_icon}} icon-element icon-element-sm"></span> {{\App\Models\Categories::getCategoryInfo($listing->cat_id)->category_name}}</div>
                </a>
                <div class="card-body position-relative">
                    <div class="d-flex align-items-center mb-1">
                        <h4 class="card-title mb-0"><a href="{{URL::to('entreprise/'.$listing->listing_slug.'/'.$listing->id)}}" title="{{$listing->title}}">{{$listing->title}}</a></h4>
                         
                    </div>
                    <p class="card-text"><i class="fal fa-map-marker-alt icon"></i>{{Str::limit($listing->address,50)}}</p>
                     
                </div>
                <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
                    <div class="star-rating" @if($listing->review_avg) data-rating="{{$listing->review_avg}}"@endif>
                        <div class="rating-counter">{{\App\Models\Reviews::getTotalReview($listing->id)}} {{trans('words.reviews')}}</div>
                    </div>                                 
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ================================
     End Card Area
================================= -->
<section class="sub_category_area bg-gray section_item_padding">
    <div class="container">
        <div class="text-center">
            <h2 class="item_sec_title mb-3">{{trans('words.job+city')}}</h2>             
        </div><br>
<div class="row d-flex align-items-stretch">
    @php
    $randomSubCategories = $sub_cat_list2->random(16);
    @endphp
    @foreach($randomSubCategories as $sub_catdata)
        @php
            $categorySlug = $cat_info->firstWhere('id', $sub_catdata->cat_id)->category_slug;
            $categoryTitle = $cat_info->firstWhere('id', $sub_catdata->cat_id)->category_nom_reel;
        @endphp

    <div class="col-lg-3 d-flex pb-3">
        <a href="{{URL::to('entreprise/'.$categorySlug.'/'.$sub_catdata->sub_category_slug.'/'.$sub_catdata->id)}}" class="card p-2 text-center text-gray hover-y h-100 w-100 d-flex justify-content-center align-items-center" title="{{$sub_catdata->sub_category_name}}"> 
            <span>{{$sub_catdata->sub_category_name}} {{trans('words.at')}}  {{$categoryTitle}}</span>
        </a>
    </div>
    @endforeach
</div>
</div>
</section>
@endif
@endsection 
<!-- ================================
     End Card Area
================================= -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

