@extends('app')

@section('head_title', 'Carburants les moins cher à ' . $cat_info->category_nom_reel . ' - Prix en direct')

@section('head_description' . $cat_info->category_nom_reel . ' - ' .
    $cat_info->category_code_postal . ' : SP95, Gazole, E85, GPL, E10, SP98. Découvrez la liste des stations-service
    disponible.')

@section('head_url', Request::url())

@section('content')
    <?php
        use Illuminate\Support\Str;

        $cheapestStation = collect($stations->records);

            $cheapestStationGazole = collect($stations->records)
            ->filter(function ($station) {
                return isset($station->fields) && isset($station->fields->price_gazole) && !empty($station->fields->price_gazole);
            })
            ->map(function ($station) {
                $averagePriceGazole = collect($station->fields->price_gazole)->average();
                $station->averagePriceGazole = $averagePriceGazole;
                return $station;
            })
            ->sortBy('averagePriceGazole')
            ->first();
            $cheapestStationGazole = $cheapestStationGazole ?? null;


            $cheapestStationSp98 = collect($stations->records)
            ->filter(function ($station) {
                return isset($station->fields) && isset($station->fields->price_sp98) && !empty($station->fields->price_sp98);
            })
            ->map(function ($station) {
                $averagePriceSP98 = collect($station->fields->price_sp98)->average();
                $station->averagePriceSP98 = $averagePriceSP98;
                return $station;
            })
            ->sortBy('averagePriceSP98')
            ->first();
            $cheapestStationSp98 = $cheapestStationSp98 ?? null;


            $cheapestStationSp95 = collect($stations->records)
            ->filter(function ($station) {
                return isset($station->fields) && isset($station->fields->price_sp95) && !empty($station->fields->price_sp95);
            })
            ->map(function ($station) {
                $averagePriceSP95 = collect($station->fields->price_sp95)->average();
                $station->averagePriceSP95 = $averagePriceSP95;
                return $station;
            })
            ->sortBy('averagePriceSP95')
            ->first();
            $cheapestStationSp95 = $cheapestStationSp95 ?? null;

            
            $cheapestStationGplc = collect($stations->records)
            ->filter(function ($station) {
                return isset($station->fields) && isset($station->fields->price_gplc) && !empty($station->fields->price_gplc);
            })
            ->map(function ($station) {
                $averagePriceGplc = collect($station->fields->price_gplc)->average();
                $station->averagePriceGplc = $averagePriceGplc;
                return $station;
            })
            ->sortBy('averagePriceGplc')
            ->first();
            $cheapestStationGplc = $cheapestStationGplc ?? null;


            $cheapestStationE10 = collect($stations->records)
            ->filter(function ($station) {
                return isset($station->fields) && isset($station->fields->price_e10) && !empty($station->fields->price_e10);
            })
            ->map(function ($station) {
                $averagePriceE10 = collect($station->fields->price_e10)->average();
                $station->averagePriceE10 = $averagePriceE10;
                return $station;
            })
            ->sortBy('averagePriceE10')
            ->first();
            $cheapestStationE10 = $cheapestStationE10 ?? null;


            $cheapestStationE85 = collect($stations->records)
            ->filter(function ($station) {
                return isset($station->fields) && isset($station->fields->price_e85) && !empty($station->fields->price_e85);
            })
            ->map(function ($station) {
                $averagePriceE85 = collect($station->fields->price_e85)->average();
                $station->averagePriceE85 = $averagePriceE85;
                return $station;
            })
            ->sortBy('averagePriceE85')
            ->first();
            $cheapestStationE85 = $cheapestStationE85 ?? null;

            //echo $cheapestStation;

            $i = 0;

            /*$infos = $cat_info;

            echo $infos*/

    ?>
    <!-- ================================
         Start Breadcrumb Area
    ================================= -->

   {{-- @dd($cheapestStation[2]->fields->services); --}}



<!-- Single Product Start -->
<section class="container-fluid py-5 mt-3" >
    <div class="container">
        <div class="row mb-5" style="display: flex; align-items: center;">
            <h1 class="mb-3 text-center">Trouver une station essence à {{ $cat_info->category_nom_reel }}</h1>
            <div class="col-lg-8 col-xl-9 mt-5">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">    
                            <a href="#">
                                <img src="{{URL::to('upload/category/'.$cat_info->category_image)}}" class="img-fluid rounded" alt="Image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 mt-5">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h4 class="text-center">Carburant le moins cher proche de {{ $cat_info->category_nom_reel }}</h4>
                            <ul class="list-unstyled fruite-categorie">
                                <li class="d-flex justify-content-between fruite-name text-primary">
                                    Gazole
                                    @isset($cheapestStationGazole->fields->price_gazole)
                                        <span>{{$cheapestStationGazole->fields->price_gazole * 1000}}€</span>
                                    @endisset
                                    @empty($cheapestStationGazole->fields->price_gazole)
                                        <span>///</span>
                                    @endempty
                                </li>

                                <li class="d-flex justify-content-between fruite-name text-primary">
                                    SP98
                                    @isset($cheapestStationSp98->fields->price_sp98)
                                        <span>{{$cheapestStationSp98->fields->price_sp98 * 1000}}€</span>
                                    @endisset
                                    @empty($cheapestStationSp98->fields->price_sp98)
                                        <span>///</span>
                                    @endempty
                                </li>

                                <li class="d-flex justify-content-between fruite-name text-primary">
                                    SP95
                                    @isset($cheapestStationSp95->fields->price_sp95)
                                        <span>{{$cheapestStationSp95->fields->price_sp95 * 1000}}€</span>
                                    @endisset
                                    @empty($cheapestStationSp95->fields->price_sp95)
                                        <span>///</span>
                                    @endempty
                                </li>

                                <li class="d-flex justify-content-between fruite-name text-primary">
                                    GPLc
                                    @isset($cheapestStationGplc->fields->price_gplc)
                                        <span>{{$cheapestStationGplc->fields->price_gplc * 1000}}€</span>
                                    @endisset
                                    @empty($cheapestStationGplc->fields->price_gplc)
                                        <span>///</span>
                                    @endempty
                                </li>

                                <li class="d-flex justify-content-between fruite-name text-primary">
                                    E10
                                    @isset($cheapestStationE10->fields->price_e10)
                                        <span>{{$cheapestStationE10->fields->price_e10 * 1000}}€</span>
                                    @endisset
                                    @empty($cheapestStationE10->fields->price_e10)
                                        <span>///</span>
                                    @endempty
                                </li> 

                                <li class="d-flex justify-content-between fruite-name text-primary">
                                    E85
                                    @isset($cheapestStationE85->fields->price_e85)
                                        <span>{{$cheapestStationE85->fields->price_e85 * 1000}}€</span>
                                    @endisset
                                    @empty($cheapestStationE85->fields->price_e85)
                                        <span>///</span>
                                    @endempty
                                </li>    
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>

    @foreach ($cheapestStation as $stations)
       
        <div class="container my-4">
            <div class="station-card">
                <div class="station-header">
                    <div>
                        @isset($stations->fields->brand)
                            <div>{{$stations->fields->brand}}</div>
                        @endisset
                        @empty($stations->fields->brand)
                            <div>///</div>
                        @endempty

                        @isset($stations->fields->name)
                            <h5>{{$stations->fields->name}}</h5>
                        @endisset
                        @empty($stations->fields->name)
                            <div>///</div>
                        @endempty

                        @if(isset($stations->fields->address, $stations->fields->cp, $stations->fields->city))
                            <p>{{$stations->fields->address}} {{$stations->fields->cp}} {{$stations->fields->city}}</p>
                        @endif
                        @if(empty($stations->fields->address) || empty($stations->fields->cp) || empty($stations->fields->city))
                            <p>///</p>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="price-row">
                    <div class="price-cell gazole">Gazole</div>
                    <div class="price-cell sp95">SP95</div>
                    <div class="price-cell sp98">SP98</div>
                    <div class="price-cell gplc">GPLc</div>
                    <div class="price-cell e10">E10</div>
                    <div class="price-cell e85">E85</div>
                    </div>
            
                    <div class="price-row">

                        @isset($stations->fields->price_gazole)
                            <div class="price-cell price">{{$stations->fields->price_gazole * 1000}}€</div>
                        @endisset
                        @empty($stations->fields->price_gazole)
                            <div class="price-cell price">///</div>
                        @endempty

                        @isset($stations->fields->price_sp95)
                            <div class="price-cell price">{{$stations->fields->price_sp95 * 1000}}€</div>
                        @endisset
                        @empty($stations->fields->price_sp95)
                            <div class="price-cell price">///</div>
                        @endempty

                        @isset($stations->fields->price_sp98)
                            <div class="price-cell price">{{$stations->fields->price_sp98 * 1000}}€</div>
                        @endisset
                        @empty($stations->fields->price_sp98)
                            <div class="price-cell price">///</div>
                        @endempty

                        @isset($stations->fields->price_gplc)
                            <div class="price-cell price">{{$stations->fields->price_gplc * 1000}}€</div>
                        @endisset
                        @empty($stations->fields->price_gplc)
                            <div class="price-cell price">///</div>
                        @endempty

                        @isset($stations->fields->price_e10)
                            <div class="price-cell price">{{$stations->fields->price_e10 * 1000}}€</div>
                        @endisset
                        @empty($stations->fields->price_e10)
                            <div class="price-cell price">///</div>
                        @endempty

                        @isset($stations->fields->price_e85)
                            <div class="price-cell price">{{$stations->fields->price_e85 * 1000}}€</div>
                        @endisset
                        @empty($stations->fields->price_e85)
                            <div class="price-cell price">///</div>
                        @endempty
                    </div>
                </div>

                <div style="display: flex; justify-content: start;" class="mt-3">
                    <button class="btn btn-outline-primary" id="detail_station" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl{{$i}}">
                        En savoir plus
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-xl{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel{{$i}}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content px-5 py-2" style="display: grid; grid-template-columns: 75% 25%;">
                    <div id="liste_services">
                        <h2 class="my-3">Services</h2>
                        @isset($stations->fields->services)
                            <div>
                                {!! str_replace('/', '<br>', $stations->fields->services) !!}
                            </div>                        
                        @endisset
                        @empty($stations->fields->services)
                            <p>///</p>
                        @endempty
                    </div>                
                    
                    @php
                        $timetable = isset($stations->fields->timetable) ? json_decode($stations->fields->timetable) : [];

                        $tableau_jours = [];

                    @endphp
                    
                    @if (empty($timetable))
                        <div>Les horaires ne sont pas renseignées</div>
                    @else
                        <div id="jours-semaine">
                                <h2 class="my-3" id="myExtraLargeModalLabel{{$i}}">Horaires</h2>
                                @foreach($timetable as $day)
                                    @php

                                        array_push($tableau_jours, $day /*,$schedule*/);

                                        $order = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

                                        usort($tableau_jours, function ($a, $b) use ($order) {
                                            $posA = array_search($a, $order);
                                            $posB = array_search($b, $order);
                                            return $posA - $posB;
                                        });

                                        //print_r($tableau_jours);
                                        //print_r( $timetable)

                                    @endphp
                                @endforeach
                                @foreach($timetable as $day => $schedule)
                                    @if (!isset($schedule->ouverture) || !isset($schedule->fermeture))
                                        @continue
                                    @endif
                                            @if($schedule->ouvert)
                                                <div style="display: flex; justify-content: space-between;">
                                                    <span>{{$day}}</span> 
                                                    <span> {{$schedule->ouverture}} - {{$schedule->fermeture}}</span>
                                                </div>
                                            @else 
                                                <div style="display: flex; justify-content: space-between;">
                                                    <span>{{$day}}</span> 
                                                    <span>Fermé</span>
                                                </div>
                                            @endif
                                @endforeach
                        </div>
                    @endif
                    <div id="map" class="mx-5" style="display: none; width: 800px; height: 400px;"></div>
                </div>
            </div>
        </div>
        @php
            $i++;
        @endphp
    @endforeach
    

<!-- Single Product End -->

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /*function afficherJoursSemaineEtHoraires() {
        // Tableau contenant les jours de la semaine avec leurs horaires
        const joursHoraires = [
            { jour: "Lundi", horaires: "08h00 - 18h00" },
            { jour: "Mardi", horaires: "08h00 - 18h00" },
            { jour: "Mercredi", horaires: "08h00 - 18h00" },
            { jour: "Jeudi", horaires: "08h00 - 18h00" },
            { jour: "Vendredi", horaires: "08h00 - 18h00" },
            { jour: "Samedi", horaires: "09h00 - 13h00" },
            { jour: "Dimanche", horaires: "Fermé" }
        ];

        // Sélection de la balise <ul> où les éléments <li> seront insérés
        const ulElement = document.getElementById('jours-semaine');

        // Boucle à travers la liste des jours avec leurs horaires
        joursHoraires.forEach(function(jourHoraire) {
            // Création d'un élément <li> pour chaque jour
            const liElement = document.createElement('li');
            
            // Texte à afficher : "Jour : Horaire"
            liElement.textContent = `${jourHoraire.jour} : ${jourHoraire.horaires}`;
            
            // Ajoute l'élément <li> au <ul>
            ulElement.appendChild(liElement);
        });
    }

    function afficherServices(){

        const services = ["Station de gonflage", "Automate CB 24/24", "Distributeur automatique de billets",
        "Toilettes publiques", "Lavage automatique"];

        const ulElement2 = document.getElementById('liste_services');
        console.log(ulElement2)

        for (service of services){
            console.log(service);

            const liElement2 = document.createElement('li');

            liElement2.textContent = service;

            ulElement2.appendChild(liElement2);
        }
    }

    // Fonction pour afficher la carte
    function afficherCarte() {
            // Afficher la div contenant la carte
            document.getElementById('map').style.display = 'block';
            
            // Coordonnées de l'adresse spécifiée (Avenue François Pignier, 01000 Bourg-En-Bresse, France)
            const coords = [48.862725, 2.287592]; // Lat: 48.862725, Lng: 2.287592

            // Initialiser la carte
            const map = L.map('map').setView(coords, 15);

            // Ajouter la couche de tuiles OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Ajouter un marqueur à l'adresse spécifiée
            L.marker(coords).addTo(map)
                .bindPopup("Station essence E.Leclerc<br>Avenue François Pignier<br>01000 Bourg-En-Bresse, France")
                .openPopup();
        }

        // Ajouter un écouteur d'événement au bouton
        document.getElementById('detail_station').addEventListener('click', function () {
            // Appelle la fonction pour afficher les jours et horaires
            //afficherJoursSemaineEtHoraires();
            //afficherServices();
            //afficherCarte();
        });*/
</script>

@endsection