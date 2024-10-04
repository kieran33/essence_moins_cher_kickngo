@extends('app')

@section('head_title', 'Stations à proximité | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")


<section class="container mt-5">
    <h1 class="text-center mb-5">Rechercher une station à proximité</h1>
    <h2 class="text-center mb-3">Activer la Géolocalisation</h2>
    <div class="text-center">
        <button id="locateBtn" class="btn btn-primary mb-3">Demander la Géolocalisation</button>
        <p id="location-status" class="mt-3"></p>
    </div>

    <h2 class="text-center">Affichez une ville sur la carte</h2>
    <div class="d-flex justify-content-center my-4">
    
        <div class="position-relative">

            {!! Form::open(['method' => 'GET', 'id' => 'search-form']) !!}

                <input type="text" id="cityInput" class="py-3 px-4 typeahead-cat" placeholder="{{ trans('words.category') }}" style="border: 1px solid black;">
                <input type="hidden" id="category-slug">

                <button class="btn btn-primary py-3 px-4 text-white text-center" id="searchCityBtn" type="submit" style="border-radius: 0px;">
                    {{ trans('words.search') }}
                </button>
                <button class="btn btn-primary py-3 px-4 text-white text-center" id="resetCityBtn" type="submit" style="border-radius: 0px;">
                    Réinitialiser
                </button>

            {!! Form::close() !!}

            <script>
                if ($('input.typeahead-cat').length > 0) {
                    var pathCat = "{{ route('autocompleteCat') }}";
                    var $input = $('input.typeahead-cat'); // Store the reference to input
                    var $hiddenInput = $('#category-slug'); // Store the reference to hidden input

                    $input.typeahead({
                        source: function(query, process) {
                            return $.get(pathCat, { query: query }, function(data) {
                                return process(data);
                            });
                        },
                        displayText: function(item) {
                            return item.category_name;
                        },
                        afterSelect: function(item) {
                            $input.val(item.category_name); // Set the input value to the selected category name
                            $hiddenInput.val(item.category_slug); // Set the hidden input to the selected category slug
                        }
                    });
                }

                $('#search-form').on('submit', function(e) {
                    e.preventDefault(); // Prevent the default form submission
                    
                    var slug = $hiddenInput.val(); // Get the slug from hidden input
                    var url = "{{ route('categories.search') }}?search=" + slug; // Prepare the search URL

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            // Handle success response (e.g., render the results on the page)
                            //console.log('Success:', response);
                        },
                        error: function(xhr) {
                            // Handle error response
                            //console.log('Error:', xhr);
                        }
                    });
                });
            </script>

        </div>
    </div>
    <div id="result" class="my-3" style="font-size: 1.5rem;"></div>

    <style>
        #map {
            height: 500px;
        }
    </style>

    <div id="map"></div>
</section>

<div class="container my-5" id="container_station"></div>

<div class="container">
    <div id="modalContainer"></div> <!-- Conteneur pour les modales générées -->
</div>


<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script JavaScript -->
<script>

    let liste_marker = [];

    // Initialisation de la carte sur une position par défaut
    var map = L.map('map').setView([48.8566, 2.3522], 13); // Vue initiale sur Paris

    // Charger les tuiles de la carte avec Leaflet et OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;

    const location_status = document.getElementById("location-status");

    function creerElementsRechercheVille()
    {
        var city = document.getElementById('cityInput').value;

        const deux_derniers_caractères = city.slice(-2);
        
        if(/^\d{2}$/.test(deux_derniers_caractères)){
            var city_up = city.toUpperCase().slice(8, -3);
        }
        else{
            var city_up = city.toUpperCase().slice(8);
        }

        // Utilisation de l'API Nominatim d'OpenStreetMap pour la géocodification de la ville
        var url = `https://nominatim.openstreetmap.org/search?format=json&q=${city}`;

        var url2 = `https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/prix_des_carburants_j_7/records?where=city%3D%22${city_up}%22&limit=100`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    var lat = data[0].lat;
                    var lon = data[0].lon;

                    // Centrer la carte sur la ville recherchée
                    map.setView([lat, lon], 13);

                    // Ajouter ou déplacer le marqueur sur la ville
                    if (marker) {
                        marker.setLatLng([lat, lon]);
                        marker._popup.setContent(city);
                        liste_marker.push(marker);
                    } else {
                        marker = L.marker([lat, lon]).addTo(map).bindPopup(city).openPopup();
                        liste_marker.push(marker);
                    }
                } else {
                    alert("Ville introuvable.");
                }
            })
            .catch(error => {
                console.error('Erreur lors de la recherche de ville :', error);
                alert("Une erreur s'est produite lors de la recherche de la ville.");
            });
            
            let data_station;

            fetch(url2)
            .then(response => response.json())
            .then(data => {
                data_station = data;
                console.log('data', data)
            })
            .catch(error => {
                console.error('Erreur lors de la recherche de ville :', error);
                alert("Une erreur s'est produite lors de la recherche de la ville.");
            });

            setTimeout(() => {               
                let resultats = Object.values(data_station).map(station => {
                    return station;
                });

                const resultats_string = JSON.stringify(resultats);

                const resultats_json = JSON.parse(resultats_string);

                let tableau_horaire_station = [];

                for(let i=0; i<=resultats_json[1].length; i++){
                    if(resultats_json[1][i].geo_point !== null && resultats_json[1][i].geo_point !== undefined)
                    {
                        if ((resultats_json[1][i].geo_point.lat !== null && resultats_json[1][i].geo_point.lat !== undefined) 
                        && (resultats_json[1][i].geo_point.lon !== null && resultats_json[1][i].geo_point.lon !== undefined)) 
                        {
                            liste_marker.push(L.marker([resultats_json[1][i].geo_point.lat, resultats_json[1][i].geo_point.lon]).addTo(map).bindTooltip(resultats_json[1][i].name).openTooltip());

                            const div_liste_services = document.getElementById('liste_services');

                                        const div_jour = document.getElementById('jour');

                                        const div_horaire = document.getElementById('horaire');

                                        const div_station_card = document.createElement('div');
                                        div_station_card.classList.add('station-card', 'my-3', 'element_card_station');
                                        div_station_card.setAttribute('id', 'div_station_card');

                                        const div_station_header = document.createElement('div');
                                        div_station_header.classList.add('station-header', 'element_card_station');
                                        div_station_header.setAttribute('id', 'div_station_header');

                                        const div_station_header_texte = document.createElement('div');
                                        div_station_header_texte.classList.add('element_card_station');
                                        div_station_header_texte.setAttribute('id', 'div_station_header');

                                        const titre_station_marque = document.createElement('h5');
                                        titre_station_marque.innerHTML = resultats_json[1][i].brand;
                                        titre_station_marque.classList.add('element_card_station');
                                        titre_station_marque.setAttribute('id', 'titre_station_marque');

                                        const titre_station_nom = document.createElement('h5');
                                        titre_station_nom.innerHTML = resultats_json[1][i].name;
                                        titre_station_nom.classList.add('element_card_station');

                                        const titre_station_adresse = document.createElement('p');
                                        titre_station_adresse.innerHTML = resultats_json[1][i].address + ' ' + resultats_json[1][i].cp + ' ' + resultats_json[1][i].city;
                                        titre_station_adresse.classList.add('element_card_station');

                                        const container_station = document.getElementById('container_station');

                                        const div_ligne_tarif = document.createElement('div');
                                        div_ligne_tarif.classList.add('price-row', 'element_card_station');

                                        const div_ligne_tarif_prix = document.createElement('div');
                                        div_ligne_tarif_prix.classList.add('price-row', 'element_card_station');

                                        const div_gazole = document.createElement('div');
                                        div_gazole.classList.add('price-cell', 'gazole', 'element_card_station');
                                        div_gazole.innerHTML = "Gazole";

                                        const div_sp95 = document.createElement('div');
                                        div_sp95.classList.add('price-cell', 'sp95', 'element_card_station');
                                        div_sp95.innerHTML = "SP95";

                                        const div_sp98 = document.createElement('div');
                                        div_sp98.classList.add('price-cell', 'sp98', 'element_card_station');
                                        div_sp98.innerHTML = "SP98";

                                        const div_gplc = document.createElement('div');
                                        div_gplc.classList.add('price-cell', 'gplc', 'element_card_station');
                                        div_gplc.innerHTML = "GPLC";

                                        const div_e10 = document.createElement('div');
                                        div_e10.classList.add('price-cell', 'e10', 'element_card_station');
                                        div_e10.innerHTML = "E10";

                                        const div_e85 = document.createElement('div');
                                        div_e85.classList.add('price-cell', 'e85', 'element_card_station');
                                        div_e85.innerHTML = "E85";                

                                        const div_prix_gazole = document.createElement('div');
                                        div_prix_gazole.classList.add('price-cell', 'price', 'element_card_station');
                                        const prix_gazole = resultats_json[1][i].price_gazole * 1000
                                        if(resultats_json[1][i].price_gazole !== "" && resultats_json[1][i].price_gazole !== null && resultats_json[1][i].price_gazole !== undefined)  
                                        {
                                            div_prix_gazole.innerHTML = prix_gazole.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_gazole.innerHTML = "///";
                                        }

                                        const div_prix_sp95 = document.createElement('div');
                                        div_prix_sp95.classList.add('price-cell', 'price', 'element_card_station');
                                        const prix_sp95 = resultats_json[1][i].price_sp95 * 1000
                                        if(resultats_json[1][i].price_sp95 !== "" && resultats_json[1][i].price_sp95 !== null && resultats_json[1][i].price_sp95 !== undefined)  
                                        {
                                            div_prix_sp95.innerHTML = prix_sp95.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_sp95.innerHTML = "///";
                                        }

                                        const div_prix_sp98 = document.createElement('div');
                                        div_prix_sp98.classList.add('price-cell', 'price', 'element_card_station');
                                        const prix_sp98 = resultats_json[1][i].price_sp98 * 1000
                                        if(resultats_json[1][i].price_sp98 !== "" && resultats_json[1][i].price_sp98 !== null && resultats_json[1][i].price_sp98 !== undefined)  
                                        {
                                            div_prix_sp98.innerHTML = prix_sp98.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_sp98.innerHTML = "///";
                                        }

                                        const div_prix_gplc= document.createElement('div');
                                        div_prix_gplc.classList.add('price-cell', 'price', 'element_card_station');
                                        const prix_gplc = resultats_json[1][i].price_gplc * 1000
                                        if(resultats_json[1][i].price_gplc !== "" && resultats_json[1][i].price_gplc !== null && resultats_json[1][i].price_gplc !== undefined)  
                                        {
                                            div_prix_gplc.innerHTML = prix_gplc.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_gplc.innerHTML = "///";
                                        }

                                        const div_prix_e10 = document.createElement('div');
                                        div_prix_e10.classList.add('price-cell', 'price', 'element_card_station');
                                        const prix_e10 = resultats_json[1][i].price_e10 * 1000
                                        if(resultats_json[1][i].price_e10 !== "" && resultats_json[1][i].price_e10 !== null && resultats_json[1][i].price_e10 !== undefined)  
                                        {
                                            div_prix_e10.innerHTML = prix_e10.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_e10.innerHTML = "///";
                                        }

                                        const div_prix_e85 = document.createElement('div');
                                        div_prix_e85.classList.add('price-cell', 'price', 'element_card_station');
                                        const prix_e85 = resultats_json[1][i].price_e85 * 1000
                                        if(resultats_json[1][i].price_e85 !== "" && resultats_json[1][i].price_e85 !== null && resultats_json[1][i].price_e85 !== undefined)  
                                        {
                                            div_prix_e85.innerHTML = prix_e85.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_e85.innerHTML = "///";
                                        }

                                        const div_button = document.createElement('div');
                                        div_button.classList.add('mt-3', 'element_card_station');
                                        div_button.style.display = "flex";
                                        div_button.style.justifyContent = "start";

                                        const button_details = document.createElement('button');
                                        button_details.classList.add('btn', 'btn-outline-primary', 'element_card_station');
                                        button_details.setAttribute('id', 'detail_station');
                                        button_details.setAttribute('type', 'button');
                                        button_details.setAttribute('data-bs-toggle', 'modal');
                                        button_details.setAttribute('data-bs-target', `#modal${i}`);
                                        button_details.innerHTML = "En savoir plus";

                                        container_station.appendChild(div_station_card);

                                        div_station_card.appendChild(div_station_header);

                                        div_station_header.appendChild(div_station_header_texte);

                                        div_station_header_texte.appendChild(titre_station_marque);
                                        div_station_header_texte.appendChild(titre_station_nom);
                                        div_station_header_texte.appendChild(titre_station_adresse);

                                        div_station_card.appendChild(div_ligne_tarif);
                                        div_station_card.appendChild(div_ligne_tarif_prix);

                                        div_ligne_tarif.appendChild(div_gazole);
                                        div_ligne_tarif.appendChild(div_sp95);
                                        div_ligne_tarif.appendChild(div_sp98);
                                        div_ligne_tarif.appendChild(div_gplc);
                                        div_ligne_tarif.appendChild(div_e10);
                                        div_ligne_tarif.appendChild(div_e85);

                                        div_ligne_tarif_prix.appendChild(div_prix_gazole);
                                        div_ligne_tarif_prix.appendChild(div_prix_sp95);
                                        div_ligne_tarif_prix.appendChild(div_prix_sp98);
                                        div_ligne_tarif_prix.appendChild(div_prix_gplc);
                                        div_ligne_tarif_prix.appendChild(div_prix_e10);
                                        div_ligne_tarif_prix.appendChild(div_prix_e85);
                                        
                                        div_station_card.appendChild(div_button);

                                        div_button.appendChild(button_details);

                                        let serviceHTML = '';

                                        let horaireHTML = '';

                                        if(resultats_json[1][i].services === null || resultats_json[1][i].services === undefined){
                                            serviceHTML += `<p>Pas de services</p>`
                                            }else{
                                                for(let j = 0; j<resultats_json[1][i].services.length; j++){
                                                    serviceHTML += `<p>${resultats_json[1][i].services[j]}</p>`
                                                }
                                            }

                                            tableau_horaire_station.push(JSON.parse(resultats_json[1][i].timetable));

                                            const tableau_station_filtrer = tableau_horaire_station.filter(horaire => horaire !== null)

                                            //console.log('tableau filtrer', tableau_station_filtrer)

                                            let horaire_station_tableau_filtrer = Object.entries(tableau_station_filtrer).map(horaire => {
                                                return horaire;
                                            });

                                            console.log('tableau station filtrer', horaire_station_tableau_filtrer[0])

                                            horaire_station_tableau_filtrer.forEach((station_planning) => {
                                                console.log('semaine horaire', station_planning[1]['Dimanche']);                      
                                            });

                                            const jour_semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

                                            for (let m = 0; m<jour_semaine.length; m++){
                                                horaire_station_tableau_filtrer.forEach((station_planning) => {
                                                    if(station_planning[1][jour_semaine[m]].ouverture && station_planning[1][jour_semaine[m]].fermeture){
                                                        horaireHTML += `<p>${station_planning[1][jour_semaine[m]].ouverture} - ${station_planning[1][jour_semaine[m]].fermeture}</p>` 
                                                    } else {
                                                        horaireHTML += `<p>Horaires indisponible</p>`
                                                    }                                        
                                                });
                                            }



                                               /* const nomJour = jour[0];
                                                const detailsHoraires = jour[1];

                                                if (detailsHoraires.ouvert) {
                                                horaireHTML += `<p>${nomJour} ${detailsHoraires.ouverture} - ${detailsHoraires.fermeture}</p>`
                                                } else {
                                                    horaireHTML += `<p>${nomJour}: Fermé</p>`
                                                }*/
                                            //});

                                            //let horaire_station_tableau2 = Object.entries(JSON.parse(resultats_json[1][i].timetable));

                                            /*let horaire_station_tableau2 = 
                                                if(Object.entries(JSON.parse(resultats_json[1][i].timetable)) === null || Object.entries(JSON.parse(resultats_json[1][i].timetable)) === undefined){
                                                    console.log('np horaire');
                                                } else{
                                                    Object.entries(JSON.parse(resultats_json[1][i].timetable)).map(horaire => {
                                                    return horaire;
                                                    });
                                                }*/
                                            
                                            //console.log('tableau horaire', horaire_station_tableau);
                                            //console.log('tableau horaire détails', horaire_station_tableau[0][1].fermeture);

                                            /*horaire_station_tableau.forEach((jour) => {
                                                const nomJour = jour[0];
                                                const detailsHoraires = jour[1];

                                                if (detailsHoraires.ouvert) {
                                                horaireHTML += `<p>${nomJour} ${detailsHoraires.ouverture} - ${detailsHoraires.fermeture}</p>`
                                                } else {
                                                    horaireHTML += `<p>${nomJour}: Fermé</p>`
                                                }
                                            });*/


                                            /*if(horaire_station_tableau[i] === null || horaire_station_tableau[i] === undefined){
                                                horaireHTML += `<p>Pas d'horaires'</p>`
                                            }else{
                                                horaire_station_tableau.forEach((jour) => {
                                                const nomJour = jour[0];
                                                const detailsHoraires = jour[1];

                                                if (detailsHoraires.ouvert) {
                                                console.log(`${nomJour}: Ouverture à ${detailsHoraires.ouverture}, Fermeture à ${detailsHoraires.fermeture}`);
                                                } else {
                                                    console.log(`${nomJour}: Fermé`);
                                                }
                                            });*/

                                            const modalContainer = document.getElementById('modalContainer');
                               
                                            // Créer une modale avec un ID unique pour chaque itération
                                            const modalHTML = `
                                            <div class="modal fade bd-example-modal-xl" id="modal${i}" tabindex="-1" aria-labelledby="modalLabel${i}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel${i}"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                       ${serviceHTML} 
                                                    </div>
                                                    <div>
                                                       ${horaireHTML} 
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>`;

                                            // Ajouter le HTML de la modale au conteneur
                                            modalContainer.innerHTML += modalHTML;   
                        }
                        else{
                            console.log('Pas de coordonnées');
                        }             
                    }
                }        
            }, 2000);
            var liste_elements_station = document.getElementsByClassName('.element_card_station');
            console.log(liste_elements_station.length);
    }

    function creerElementsGeolocalisation()
    {
        if (navigator.geolocation) {

            location_status.innerText = "Géolocalisation en cours...";

            navigator.geolocation.getCurrentPosition(function (position) 
            {
                location_status.innerText = "";

                var lat = position.coords.latitude;
                var lon = position.coords.longitude;

                // Centrer la carte sur la position de l'utilisateur
                map.setView([lat, lon], 13);

                // Ajouter un marqueur pour la position de l'utilisateur
                if (marker) {
                    marker.setLatLng([lat, lon]);
                } else {
                    marker = L.marker([lat, lon]).addTo(map).bindPopup("Vous êtes ici.").openPopup();
                }

                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data)
                        const city = data.address.city || data.address.town || data.address.village || "Ville non trouvée";
                        document.getElementById('result').innerText = `Vous êtes à proximité de : ${city}`;

                        var city_up = city.toUpperCase();

                        var url2 = `https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/prix_des_carburants_j_7/records?where=city%3D%22${city_up}%22&limit=100`;

                        let data_station;

                        fetch(url2)
                        .then(response => response.json())
                        .then(data => {
                            data_station = data;
                            console.log('data', data)
                        })
                        .catch(error => {
                            console.error('Erreur lors de la recherche de ville :', error);
                            alert("Une erreur s'est produite lors de la recherche de la ville.");
                        });

                        setTimeout(() => {                        
                            let resultats = Object.values(data_station).map(station => {
                                return station;
                            });

                            const resultats_string = JSON.stringify(resultats);

                            const resultats_json = JSON.parse(resultats_string);

                            for(let i=0; i<=resultats_json[1].length; i++){
                                if(resultats_json[1][i].geo_point !== null && resultats_json[1][i].geo_point !== undefined)
                                {
                                    if ((resultats_json[1][i].geo_point.lat !== null && resultats_json[1][i].geo_point.lat !== undefined) 
                                    && (resultats_json[1][i].geo_point.lon !== null && resultats_json[1][i].geo_point.lon !== undefined)) 
                                    {
                                        L.marker([resultats_json[1][i].geo_point.lat, resultats_json[1][i].geo_point.lon]).addTo(map).bindTooltip(resultats_json[1][i].name).openTooltip();

                                        const div_liste_services = document.getElementById('liste_services');

                                        const div_jour = document.getElementById('jour');

                                        const div_horaire = document.getElementById('horaire');

                                        const div_station_card = document.createElement('div');
                                        div_station_card.classList.add('station-card', 'my-3');
                                        //div_station_card.setAttribute('id', 'div_station_card');

                                        const div_station_header = document.createElement('div');
                                        div_station_header.classList.add('station-header');

                                        const div_station_header_texte = document.createElement('div');

                                        const titre_station_marque = document.createElement('h5');
                                        titre_station_marque.innerHTML = resultats_json[1][i].brand;

                                        const titre_station_nom = document.createElement('h5');
                                        titre_station_nom.innerHTML = resultats_json[1][i].name;

                                        const titre_station_adresse = document.createElement('p');
                                        titre_station_adresse.innerHTML = resultats_json[1][i].address + ' ' + resultats_json[1][i].cp + ' ' + resultats_json[1][i].city;

                                        const container_station = document.getElementById('container_station');

                                        const div_ligne_tarif = document.createElement('div');
                                        div_ligne_tarif.classList.add('price-row');

                                        const div_ligne_tarif_prix = document.createElement('div');
                                        div_ligne_tarif_prix.classList.add('price-row');

                                        const div_gazole = document.createElement('div');
                                        div_gazole.classList.add('price-cell', 'gazole');
                                        div_gazole.innerHTML = "Gazole";

                                        const div_sp95 = document.createElement('div');
                                        div_sp95.classList.add('price-cell', 'sp95');
                                        div_sp95.innerHTML = "SP95";

                                        const div_sp98 = document.createElement('div');
                                        div_sp98.classList.add('price-cell', 'sp98');
                                        div_sp98.innerHTML = "SP98";

                                        const div_gplc = document.createElement('div');
                                        div_gplc.classList.add('price-cell', 'gplc');
                                        div_gplc.innerHTML = "GPLC";

                                        const div_e10 = document.createElement('div');
                                        div_e10.classList.add('price-cell', 'e10');
                                        div_e10.innerHTML = "E10";

                                        const div_e85 = document.createElement('div');
                                        div_e85.classList.add('price-cell', 'e85');
                                        div_e85.innerHTML = "E85";                

                                        const div_prix_gazole = document.createElement('div');
                                        div_prix_gazole.classList.add('price-cell', 'price');
                                        const prix_gazole = resultats_json[1][i].price_gazole * 1000
                                        if(resultats_json[1][i].price_gazole !== "" && resultats_json[1][i].price_gazole !== null && resultats_json[1][i].price_gazole !== undefined)  
                                        {
                                            div_prix_gazole.innerHTML = prix_gazole.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_gazole.innerHTML = "///";
                                        }

                                        const div_prix_sp95 = document.createElement('div');
                                        div_prix_sp95.classList.add('price-cell', 'price');
                                        const prix_sp95 = resultats_json[1][i].price_sp95 * 1000
                                        if(resultats_json[1][i].price_sp95 !== "" && resultats_json[1][i].price_sp95 !== null && resultats_json[1][i].price_sp95 !== undefined)  
                                        {
                                            div_prix_sp95.innerHTML = prix_sp95.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_sp95.innerHTML = "///";
                                        }

                                        const div_prix_sp98 = document.createElement('div');
                                        div_prix_sp98.classList.add('price-cell', 'price');
                                        const prix_sp98 = resultats_json[1][i].price_sp98 * 1000
                                        if(resultats_json[1][i].price_sp98 !== "" && resultats_json[1][i].price_sp98 !== null && resultats_json[1][i].price_sp98 !== undefined)  
                                        {
                                            div_prix_sp98.innerHTML = prix_sp98.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_sp98.innerHTML = "///";
                                        }

                                        const div_prix_gplc= document.createElement('div');
                                        div_prix_gplc.classList.add('price-cell', 'price');
                                        const prix_gplc = resultats_json[1][i].price_gplc * 1000
                                        if(resultats_json[1][i].price_gplc !== "" && resultats_json[1][i].price_gplc !== null && resultats_json[1][i].price_gplc !== undefined)  
                                        {
                                            div_prix_gplc.innerHTML = prix_gplc.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_gplc.innerHTML = "///";
                                        }

                                        const div_prix_e10 = document.createElement('div');
                                        div_prix_e10.classList.add('price-cell', 'price');
                                        const prix_e10 = resultats_json[1][i].price_e10 * 1000
                                        if(resultats_json[1][i].price_e10 !== "" && resultats_json[1][i].price_e10 !== null && resultats_json[1][i].price_e10 !== undefined)  
                                        {
                                            div_prix_e10.innerHTML = prix_e10.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_e10.innerHTML = "///";
                                        }

                                        const div_prix_e85 = document.createElement('div');
                                        div_prix_e85.classList.add('price-cell', 'price');
                                        const prix_e85 = resultats_json[1][i].price_e85 * 1000
                                        if(resultats_json[1][i].price_e85 !== "" && resultats_json[1][i].price_e85 !== null && resultats_json[1][i].price_e85 !== undefined)  
                                        {
                                            div_prix_e85.innerHTML = prix_e85.toFixed(3) + "€";
                                        }
                                        else {
                                            div_prix_e85.innerHTML = "///";
                                        }

                                        const div_button = document.createElement('div');
                                        div_button.classList.add('mt-3');
                                        div_button.style.display = "flex";
                                        div_button.style.justifyContent = "start";

                                        const button_details = document.createElement('button');
                                        button_details.classList.add('btn', 'btn-outline-primary');
                                        button_details.setAttribute('id', 'detail_station');
                                        button_details.setAttribute('type', 'button');
                                        button_details.setAttribute('data-bs-toggle', 'modal');
                                        button_details.setAttribute('data-bs-target', `#modal${i}`);
                                        button_details.innerHTML = "En savoir plus";

                                        container_station.appendChild(div_station_card);

                                        div_station_card.appendChild(div_station_header);

                                        div_station_header.appendChild(div_station_header_texte);

                                        div_station_header_texte.appendChild(titre_station_marque);
                                        div_station_header_texte.appendChild(titre_station_nom);
                                        div_station_header_texte.appendChild(titre_station_adresse);

                                        div_station_card.appendChild(div_ligne_tarif);
                                        div_station_card.appendChild(div_ligne_tarif_prix);

                                        div_ligne_tarif.appendChild(div_gazole);
                                        div_ligne_tarif.appendChild(div_sp95);
                                        div_ligne_tarif.appendChild(div_sp98);
                                        div_ligne_tarif.appendChild(div_gplc);
                                        div_ligne_tarif.appendChild(div_e10);
                                        div_ligne_tarif.appendChild(div_e85);

                                        div_ligne_tarif_prix.appendChild(div_prix_gazole);
                                        div_ligne_tarif_prix.appendChild(div_prix_sp95);
                                        div_ligne_tarif_prix.appendChild(div_prix_sp98);
                                        div_ligne_tarif_prix.appendChild(div_prix_gplc);
                                        div_ligne_tarif_prix.appendChild(div_prix_e10);
                                        div_ligne_tarif_prix.appendChild(div_prix_e85);
                                        
                                        div_station_card.appendChild(div_button);

                                        div_button.appendChild(button_details);

                                        let serviceHTML = '';

                                        if(resultats_json[1][i].services === null || resultats_json[1][i].services === undefined){
                                            serviceHTML += `<p>Pas de services</p>`
                                        }else{
                                            for(let j = 0; j<resultats_json[1][i].services.length; j++){
                                                serviceHTML += `<p>${resultats_json[1][i].services[j]}</p>`
                                            }
                                        }

                                            const modalContainer = document.getElementById('modalContainer');
                                
                                            // Créer une modale avec un ID unique pour chaque itération
                                            const modalHTML = `
                                            <div class="modal fade bd-example-modal-xl" id="modal${i}" tabindex="-1" aria-labelledby="modalLabel${i}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel${i}"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        ${serviceHTML} 
                                                    </div>
                                                    <div>
                                                        ${resultats_json[1][i].timetable} 
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>`;

                                            // Ajouter le HTML de la modale au conteneur
                                            modalContainer.innerHTML += modalHTML;                                      
                                    }
                                    else{
                                        console.log('Pas de coordonnées');
                                    }             
                                }
                            }          

                        }, 2000);
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des données de la ville:', error);
                        document.getElementById('result').innerText = "Erreur lors de la récupération des données de la ville.";
                    });
            });

            } else {
            alert("La géolocalisation n'est pas supportée par ce navigateur.");
            }
    }

    function supprimerElements() {

        let elements = document.querySelectorAll('.element_card_station');

        elements.forEach(element => {
            element.remove()
        });

        const inputCity = document.getElementById('cityInput');
        inputCity.value = "";

        const input_cate_slug = document.getElementById('category-slug');
        input_cate_slug.value = "";

        liste_marker.forEach(marker => {
            map.removeLayer(marker);
        });

        map.setView([48.8566, 2.3522], 13);
    }

    // Fonction pour obtenir la géolocalisation
    document.getElementById('locateBtn').addEventListener('click', function () {
        creerElementsGeolocalisation();
    });

    // Fonction pour rechercher une ville et la centrer sur la carte
    document.getElementById('searchCityBtn').addEventListener('click', function () {
        creerElementsRechercheVille(); 
    });

    document.getElementById('resetCityBtn').addEventListener('click', function () {
        supprimerElements();
    });

</script>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>