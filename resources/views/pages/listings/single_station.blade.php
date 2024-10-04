@extends('app')

@section('head_title', 'Station | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
    <?php
    use Illuminate\Support\Str;
    ?>
    <!-- ================================
                 Start Breadcrumb Area
            ================================= -->

            <div class="container mt-4">
                <!-- Station Info -->
                <div class="row">
                    <div class="col-md-6">
                        <h2>Station E.Leclerc à Chantonnay</h2>
                        <h5><strong>Coordonnées</strong></h5>
                        <p>PARC ACTIVITE POLARIS NORD <br> 85110 Chantonnay</p>
                    </div>
                    <div class="col-md-6 text-md-end text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/7/75/E.Leclerc_Logo.svg/1280px-E.Leclerc_Logo.svg.png" alt="E.Leclerc Logo" width="100">
                    </div>
                </div>
            
                <!-- Fuel Prices -->
                <div class="mt-4">
                    <h5><strong>Prix des carburants</strong></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th style="background-color: #ffcc99;">Gazole</th>
                                    <th style="background-color: #99ff99;">SP95</th>
                                    <th style="background-color: #99ff66;">SP98</th>
                                    <th style="background-color: #66cc66;">E10</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.519 € <br><small>aujourd'hui</small></td>
                                    <td>1.669 € <br><small>aujourd'hui</small></td>
                                    <td>1.689 € <br><small>aujourd'hui</small></td>
                                    <td>1.595 € <br><small>aujourd'hui</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            
                <!-- Location Map -->
                <div class="mt-4">
                    <h5><strong>Localisation de la station</strong></h5>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" 
                            src="https://www.openstreetmap.org/export/embed.html?bbox=-1.0994%2C46.6709%2C-1.0951%2C46.6736&amp;layer=mapnik" 
                            style="width: 100%; height: 300px;" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            
                <!-- Services -->
                <div class="mt-4">
                    <h5><strong>Services</strong></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Station de gonflage</li>
                                <li>Boutique non alimentaire</li>
                                <li>Piste poids lourds</li>
                                <li>Restauration sur place</li>
                                <li>Laverie</li>
                                <li>Automate CB 24/24</li>
                                <li>Services réparation / entretien</li>
                                <li>DAB (Distributeur automatique de billets)</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Toilettes publiques</li>
                                <li>Location de véhicule</li>
                                <li>Restauration à emporter</li>
                                <li>Bar</li>
                                <li>Vente de gaz domestique (Butane, Propane)</li>
                                <li>Lavage automatique</li>
                                <li>Lavage manuel</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>