@extends('app')

@section('head_title',trans('words.categories').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")


 <!-- ================================
     Start Category Area
================================= -->

<?php
    //@dd($cat_list);
    //@dd($categories)
    //@dd($cat_info)
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


 <!-- Fruits Shop Start-->
 <div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div style="display: flex; flex-direction: row-reverse; justify-content: space-between;
                    align-items: center;">
                    <h1>Rechercher une ville</h1>

                    {!! Form::open(['route' => 'categories.search', 'method' => 'GET', 'id' => 'search-form']) !!}
                        
                        <div>
                            <!-- Input pour afficher le nom de la catégorie -->
                            <input type="text" class="typeahead-cat" placeholder="{{ trans('words.category') }}" style="padding: 5px; width: 200px; border: solid 1px black;">
                            <input type="hidden" id="category-slug">

                            {!! Form::submit(trans('words.search'), ['style' => 'width: 200px; border: solid 1px black; background: white; padding: 5px;']) !!}
                                
                            <a href="{{URL::to('/ville/')}}">
                                {!! Form::button(trans('words.clear'), ['style' => 'width: 200px; border: solid 1px black; background: white; padding: 5px;']) !!}
                            </a>
                        </div>          
                                
                        <script>
                            if ($('input.typeahead-cat').length > 0) {
                                var pathCat = "{{ route('autocompleteCat') }}";
                                var $input = $('input.typeahead-cat'); // Stockez la référence à l'input
                                var $hiddenInput = $('#category-slug'); // Stockez la référence à l'input caché
                                
                                $input.typeahead({
                                    source: function(query, process) {
                                        return $.get(pathCat, { query: query }, function(data) {
                                            console.log(data); // Ajoutez cette ligne pour afficher les données renvoyées
                                            return process(data);
                                        });
                                    },
                                    displayText: function(item) {
                                        return item.category_name;
                                    },
                                    afterSelect: function(item) {
                                        // Utilisez la référence à l'input pour changer sa valeur
                                        $input.val(item.category_name);
                                        // Mettez à jour la valeur de l'input caché avec le slug de la catégorie
                                        $hiddenInput.val(item.category_slug);
                                        // console.log(item); // Ajoutez cette ligne pour afficher l'objet item
                                        // console.log('Slug de la catégorie sélectionnée : ' + item.category_slug);
                                    }
                                });
                                $('#search-form').on('submit', function(e) {
                                    e.preventDefault();
                                    // console.log('Soumission du formulaire avec le slug : ' + $hiddenInput.val());
                                    window.location.href = "{{ route('categories.search') }}?search=" + $hiddenInput.val();
                                });
                            }
                        </script>
                    {!! Form::close() !!}
                </div>
                    <div class="row g-4 mt-3">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="text-center">Chercher une ville par lettre</h4>
                                        <ul class="my-3 liste_lettres" style="display: flex; flex-direction:column; align-items: center;">
                                            @foreach (range('A', 'Z') as $letter)
                                                <a href="{{ route('categories.categories_list_letter', ['letter' => $letter]) }}" style="border: solid 1px black; width: 150px; margin: 5px;">
                                                    <li class="text-center">{{ $letter }}
                                                    </li>
                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach($cat_list as $cat_data)   
                                <div class="col-3">
                                    <div>
                                        <a href="{{URL::to('ville/'.$cat_data->category_slug.'/'.$cat_data->id)}}"  title="category">
                                            <div>
                                                @if($cat_data->category_image)
                                                <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/'.$cat_data->category_image)}}" alt="category-image" class="lazy" 
                                                style="height: 150px; width: 100%; object-fit: cover;" title="category">
                                                @else
                                                <img src="{{URL::to('assets/images/img-loading.jpg')}}" data-src="{{URL::to('upload/category/default.jpg')}}" alt="category-image" class="lazy" 
                                                title="category" style="height: 150px; width: 100%; object-fit: cover;">
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3" >
                        <div class="pagination d-flex justify-content-center mt-5">
                            @include('common.pagination', ['paginator' => $cat_list, 'style' => 'width: 200px; border: solid 1px black; background: white; padding: 5px;'] )
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


@endsection