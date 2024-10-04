@extends('app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5 mb-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h1 class="mb-5 display-3 text-primary" style="opacity: 1;">Trouver une station dans différentes villes</h1>
                    <div class="position-relative mx-auto">

                        {!! Form::open(['route' => 'categories.search', 'method' => 'GET', 'id' => 'search-form']) !!}
                            
      
                            <input type="text" id="ville" class="w-50 py-3 px-4 typeahead-cat" placeholder="{{ trans('words.category') }}" style="border: 1px black solid;">
                            <input type="hidden" id="category-slug">
     
                            <button class="btn btn-primary py-3 px-4 position-absolute text-white h-100 text-center" type="submit" style="border-radius: 0px;">
                                {{trans('words.search')}}</button>

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

                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="{{URL::to('assets/images/station-essence.jpg')}}" alt="First slide"
                                style="height: 250px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{URL::to('assets/images/station-essence2.jpg')}}" alt="Second slide"
                                style="height: 250px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="carousel_bouton">
                                <button class="carousel-control-prev bg-primary" type="button" data-bs-target="#carouselId" data-bs-slide="prev"
                                style="width: 48px; height: 48px;">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next bg-primary" type="button" data-bs-target="#carouselId" data-bs-slide="next"
                                style="width: 48px; height: 48px;">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center mb-5">
                <div class="col-lg-4 text-start mb-3">
                    <h1>Villes populaires</h1>
                </div>     
                    <div class="row">
                        @php
                            $cities = [
                                ['nom_departement' => 'Paris', 'category_slug' => 'paris', 'id' => 30438, 'category_nom_reel' => 'Paris', 'image_url' => "https://i.ibb.co/zsktNpY/eiffel-tower-in-paris-151-medium-1.jpg"],
                                ['nom_departement' => 'Bouches-du-Rhône', 'category_slug' => 'marseille', 'id' => 4440, 'category_nom_reel' => 'Marseille', 'image_url' => "https://i.ibb.co/TvrYqDc/marseille-1-zuid-frankrijk-middellandse-zee-strand-vakantie-villa-oude-haven-vieux-port.jpg"],
                                ['nom_departement' => 'Rhône', 'category_slug' => 'lyon', 'id' => 28153, 'category_nom_reel' => 'Lyon', 'image_url' => "https://i.ibb.co/ykvKqPw/vignettelyon-1511545217.jpg"],
                                ['nom_departement' => 'Haute-Garonne', 'category_slug' => 'toulouse', 'id' => 11719, 'category_nom_reel' => 'Toulouse', 'image_url' => "https://i.ibb.co/X7cRZvC/incontournables-toulouse.jpg"],
                                ['nom_departement' => 'Alpes-Maritimes', 'category_slug' => 'nice', 'id' => 2050, 'category_nom_reel' => 'Nice', 'image_url' => "https://i.ibb.co/S7vvkHN/nice-au-coucher-de-soleil.jpg"],
                                ['nom_departement' => 'Loire-Atlantique', 'category_slug' => 'nantes', 'id' => 16756, 'category_nom_reel' => 'Nantes', 'image_url' => "https://i.ibb.co/KwHQsc6/5dbb44bf20132.jpg"],
                                ['nom_departement' => 'Hérault', 'category_slug' => 'montpellier', 'id' => 13339, 'category_nom_reel' => 'Montpellier', 'image_url' => "https://i.ibb.co/zNcR8NP/montpellier.jpg"],
                                ['nom_departement' => 'Bas-Rhin', 'category_slug' => 'strasbourg', 'id' => 27304, 'category_nom_reel' => 'Strasbourg', 'image_url' => "https://i.ibb.co/3NK9nbv/strasbourg.jpg"]
                            ];
                        @endphp

                        @foreach ($cities as $city)
                            <div class="col-md-6 col-lg-4 col-xl-3 my-5">
                                <div class="rounded position-relative fruite-item" style="height: 150px;">
                                    <div class="fruite-img bg-primary">
                                        <a href="{{ URL::to('ville/' . $city['category_slug'] . '/' . $city['id']) }}" style="text-decoration: none;">
                                            <img src="{{ $city['image_url'] }}" class="img-fluid w-100 object-fit-cover" alt="{{ $city['category_nom_reel'] }}"
                                            style="height: 150px;">
                                            <h5 class="text-dark text-center my-3">{{ $city['category_nom_reel'] }}</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>                     
        </div>      
    </div>
</div>
<!-- Fruits Shop End-->


<!-- Banner Section Start-->
<div class="container-fluid banner bg-secondary my-5">
    <div class="container py-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="py-4">
                    <h1 class="display-3 text-white">Trouver une station</h1>
                    <p class="fw-normal display-3 text-dark mb-4">près de chez vous</p>
                    <a href="{{ URL::to('a-proximite') }}">
                        <button style="background: none; border: 2px solid white; color: #343a40; padding: 20px;">
                            Voir les stations
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="{{URL::to('assets/images/ville.jpg')}}" class="img-fluid w-100 rounded" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section End -->


<!-- Featurs Section Start -->
<section>
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-3">
                <div class="col-md-8 col-lg-4">
                    <div class="featurs-item text-center rounded bg-light p-4" style="height: 300px;">
                        <div class="mb-3">
                            <img src="{{URL::to('assets/images/icone/rafraichir.png')}}" alt="mise à jour" style="width: 64px; height: 64px;">
                        </div>
                        <div class="featurs-content text-center">
                            <h5 class="mb-3">Mises à jour en temps réel</h5>
                            <p class="mb-0">
                                Nous comprenons que le temps, c'est de l'argent. Nos mises à jour en temps réel vous assurent que vous payez toujours le prix le plus avantageux au moment de votre visite à la station-service.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="featurs-item text-center rounded bg-light p-4" style="height: 300px;">
                        <div class="mb-3">
                            <img src="{{URL::to('assets/images/icone/carte.png')}}" alt="cartographie" style="width: 64px; height: 64px;">
                        </div>
                        <div class="featurs-content text-center">
                            <h5 class="mb-3">Cartographie Intuitive</h5>
                            <p class="mb-0">
                                Notre interface conviviale et notre cartographie interactive facilitent la localisation des stations-service proches de chez vous.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="featurs-item text-center rounded bg-light p-4" style="height: 300px;">
                        <div class="mb-3">
                            <img src="{{URL::to('assets/images/icone/fiable.png')}}" alt="donnée fiables" style="width: 64px; height: 64px;">
                        </div>
                        <div class="featurs-content text-center">
                            <h5 class="mb-3">Données Fiables</h5>
                            <p class="mb-0">
                                Nous nous engageons à fournir des données précises et fiables, pour que vous puissiez planifier vos déplacements en toute confiance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@endsection