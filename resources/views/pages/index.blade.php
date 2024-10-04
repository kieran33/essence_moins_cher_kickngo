@extends('app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


<?php

//print_r($category)
$category = $cat_info->random();

?>


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
                            $villes = [
                                [ 'id' => 30438, 'nom_ville' => 'Paris', 'image_lien' => "https://i.ibb.co/zsktNpY/eiffel-tower-in-paris-151-medium-1.jpg"],
                                [ 'id' => 4440, 'nom_ville' => 'Marseille', 'image_lien' => "https://i.ibb.co/TvrYqDc/marseille-1-zuid-frankrijk-middellandse-zee-strand-vakantie-villa-oude-haven-vieux-port.jpg"],
                                [ 'id' => 28153, 'nom_ville' => 'Lyon', 'image_lien' => "https://i.ibb.co/ykvKqPw/vignettelyon-1511545217.jpg"],
                                [ 'id' => 11719, 'nom_ville' => 'Toulouse', 'image_lien' => "https://i.ibb.co/X7cRZvC/incontournables-toulouse.jpg"],
                                [ 'id' => 2050, 'nom_ville' => 'Nice', 'image_lien' => "https://i.ibb.co/S7vvkHN/nice-au-coucher-de-soleil.jpg"],
                                [ 'id' => 16756, 'nom_ville' => 'Nantes', 'image_lien' => "https://i.ibb.co/KwHQsc6/5dbb44bf20132.jpg"],
                                [ 'id' => 13339, 'nom_ville' => 'Montpellier', 'image_lien' => "https://i.ibb.co/zNcR8NP/montpellier.jpg"],
                                [ 'id' => 27304, 'nom_ville' => 'Strasbourg', 'image_lien' => "https://i.ibb.co/3NK9nbv/strasbourg.jpg"]
                            ];
                        @endphp

                        @foreach ($villes as $ville)
                            <div class="col-md-6 col-lg-4 col-xl-3 my-5">
                                <div class="rounded position-relative fruite-item" style="height: 150px;">
                                    <div class="fruite-img">
                                        <a href="{{ URL::to('ville/' . $ville['nom_ville'] . '/' . $ville['id']) }}" style="text-decoration: none;">
                                            <img src="{{ $ville['image_lien'] }}" class="img-fluid w-100 object-fit-cover" alt="{{ $ville['nom_ville'] }}"
                                            style="height: 150px;">
                                            <h5 class="text-dark text-center my-3">{{ $ville['nom_ville'] }}</h5>
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
                        <button style="border: 2px solid white; color: #343a40; padding: 20px;">
                            Voir les stations
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">

                @php
                    // Récupère 5 villes aléatoires (ou plus, selon tes besoins)
                    $villes = [];
                    for ($i = 0; $i < 20; $i++) {
                        $ville_info = $cat_info->random(); 
                        $villes[] = [
                            'slug' => $ville_info->category_slug,
                            'id' => $ville_info->id,
                            'nom' => $ville_info->category_nom_reel,
                            'image' => $ville_info->category_image,
                        ];
                    }
                @endphp
                <div class="position-relative affichage_ville">
                    <a href="{{ URL::to('a-proximite')}}" class="ville-link-proximite">
                        <img src="{{URL::to('upload/category/'.$villes[0]['image'] )}}" class="img-fluid w-100 rounded ville-image-proximite" alt="{{ $villes[0]['nom'] }}">
                    </a>
                </div>
                <script>
                    var villes = {!! json_encode($villes) !!};
                </script>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section End -->



<script>
    $(document).ready(function() {
        var currentIndex = 0;

        // Fonction pour mettre à jour les villes affichées
        function updateVille() {
            // Il y a 4 villes affichées, il faut les changer toutes
            $('.affichage_ville').each(function(index) {
                var ville = villes[(currentIndex + index) % villes.length];  // Récupérer la ville suivante

                // Mettre à jour le lien, l'image et le nom
                $(this).find('.ville-link-proximite').attr('href', '/a-proximite/');
                $(this).find('.ville-image-proximite').attr('src', '/upload/category/' + ville.image).attr('alt', ville.nom);
                $(this).find('.ville-nom-proximite').text(ville.nom);
            });

            // Avancer dans l'index, et revenir à 0 si nécessaire
            currentIndex = (currentIndex + 4) % villes.length;
        }

        // Initialisation
        setInterval(updateVille, 5000);  // Changer toutes les 3 secondes
    });
</script>


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center mb-5">
                <div class="col-lg-4 text-start mb-3">
                    <h1>Villes à découvrir</h1>
                </div>     
                    <div class="row"> 

                        @for($i=0; $i<8; $i++)
                            <div class="col-md-6 col-lg-4 col-xl-3 my-5">
                                @php
                                    // Récupère une ville aléatoire différente à chaque itération
                                    $ville_info = $cat_info->random(); 
                                    $ville_slug = $ville_info->category_slug;
                                    $ville_id = $ville_info->id;
                                    $ville_nom = $ville_info->category_nom_reel;
                                    $ville_image = $ville_info->category_image;
                                @endphp

                                <div class="rounded position-relative fruite-item" style="height: 150px;">
                                    <div class="fruite-img">
                                        <a href="{{ URL::to('ville/' . $ville_slug . '/' . $ville_id) }}" style="text-decoration: none;">
                                            <img src="{{URL::to('upload/category/'.$ville_image)}}" class="img-fluid w-100 object-fit-cover" alt="{{$ville_nom}}"
                                            style="height: 150px;">  
                                            <h5 class="text-dark text-center my-3">{{ $ville_nom }}</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>  
                        @endfor
                    </div>                     
        </div>      
    </div>
</div>
<!-- Fruits Shop End-->



<!-- Featurs Section Start -->
<section>
    <div class="container-fluid featurs py-5" style="margin-bottom: 200px;">
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