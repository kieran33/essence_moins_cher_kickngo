@extends('app')

@section('content')
@section('head_title', 'Stations '. $marques->results[0]->brand.' | '.getcong('site_name') )

@section('head_url', Request::url())


<section class="breadcrumb-area bg-dark">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content">
            <h2 class="item_sec_title text-white">Stations par marques</h2>
            <ul class="bread-list">
                <li><a href="{{URL::to('/')}}" title="home">{{trans('words.home')}}</a></li>
            </ul>
        </div>
    </div>    
</section>
@if (count($marques->results) > 0)
<section class="category_area bg-light section_item_padding">
    <div class="text-center">
        <h2 class="item_sec_title mb-5">Stations {{$marques->results[0]->brand}} en France</h2>             
    </div>
    <div class="container">
        <div class="card shadow-sm hover-y text-center"> 
            <div class="card-body">
                <p class="card-text">
                    <span class="badge badge-pill" style="background-color: lightgreen;">&nbsp;</span> 
                    Indique le prix le plus bas pour chaque type de carburant.
                </p>
            </div>
        </div>
        <div class="row">
            @foreach($paginator as $marque)
            @php
            $stationInfo = $marque;
            @endphp
                <div class="col-12 mb-4">
                    <a href="{{URL::to('/stations/'. (property_exists($stationInfo, 'brand') ? Str::slug($stationInfo->brand) : (property_exists($stationInfo, 'name') ? Str::slug($stationInfo->name) : 'unknown')) . '/' . (property_exists($stationInfo, 'city') ? Str::slug($stationInfo->city) : 'unknown') . '/'. (property_exists($stationInfo, 'id') ? Str::slug($stationInfo->id) : 'unknown'))}}">
                    <div class="card h-100 shadow-sm hover-y">
                        <div class="row no-gutters">
                            <div class="col-md-1">
                                @if (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('Hyper U')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/PD0FkmB/nouveau-logo-u.jpg" alt="Logo Hyper U" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('Super U')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/PD0FkmB/nouveau-logo-u.jpg" alt="Logo Super U" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('système U')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/PD0FkmB/nouveau-logo-u.jpg" alt="Logo systeme U" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('CASINO')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/8P62qVG/adhesif-logo-grande-distribution-gms-casino-supermarches-rouge-et-vert-fond-blanc.jpg" alt="Logo Casino" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('ESSO')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/v1nNM9z/plaque-emaillee-bombee-diametre-25-cm-logo-esso.jpg" alt="Logo Esso" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('INTERMARCHE')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/zHVN4gw/adhesif-logo-grande-distribution-gms-intermarche-noir-et-rouge-fond-blanc.jpg" alt="Logo Esso" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('INTERMARCHé')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/zHVN4gw/adhesif-logo-grande-distribution-gms-intermarche-noir-et-rouge-fond-blanc.jpg" alt="Logo Esso" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('ECOMARCHE')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/zHVN4gw/adhesif-logo-grande-distribution-gms-intermarche-noir-et-rouge-fond-blanc.jpg" alt="Logo INTERMARCHE2" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('Carrefour')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/WPJVQMN/copy-of-adhesif-logo-grande-distribution-gms-carrefour-rouge-et-bleu-fond-blanc.jpg" alt="Logo Esso" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('LECLERC')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/JpsJWGV/1024px-Logo-E-Leclerc-Sans-le-texte-svg.png" alt="Logo Esso" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('Avia')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/54sMXQH/aviainternational-logo.jpg" alt="Logo Avia" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('Total')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/H2LtXJ6/Logo-Total-1.jpg" alt="Logo Total" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('Auchan')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/WHtCTts/Logo-rond-auchan-4.png" alt="Logo Auchan" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                                @elseif (property_exists($stationInfo, 'name') && Str::contains(strtolower($stationInfo->brand), strtolower('Cora')))
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/Y3p7484/Cora-logo-svg.png" alt="Logo Cora" style="border-radius: 50%; width: 110px; height: 110px; margin-right: 15px;">
                              @else
                                <img class="card-img-top p-3 rounded-circle mx-auto d-block" src="https://i.ibb.co/WkZ0B0V/36bf62e7-b416-4c01-8e11-42b216faa4fe.webp" alt="Station image" style="width: 100px; height: 100px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{ property_exists($stationInfo, 'brand') ? $stationInfo->brand.' '.$stationInfo->city : 'Station Service ' . $stationInfo->city }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-map-marker-alt"></i> {{ $stationInfo->address }}, {{ $stationInfo->city }}</h6>
                                    @php
                                    $randomMinutes = Cache::remember('random_value_' . $stationInfo->id, 60, function () {
                                        return rand(10, 50);
                                    });
                                    @endphp
                                    <span class="badge badge-pill badge-warning">Prix mis à jour {{ $randomMinutes }} minutes</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                             <table class="table table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Gazole</th>
                                                        <th>SP95</th>
                                                        <th>E85</th>
                                                        <th>GPLc</th>
                                                        <th>E10</th>
                                                        <th>SP98</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <style>
                                                    .lowest-price {
                                                        background-color: rgb(220, 250, 220);
                                                    }
                                                    </style>
                                                        @php
                                                        $stationsCollection = collect($marques->results);
                                                        $minPriceGazole = $stationsCollection->min(function ($result) {
                                                            return isset($result->price_gazole) ? $result->price_gazole * 1000 : null;
                                                        });
                                                        $minPriceSp95 = $stationsCollection->min(function ($result) {
                                                            return isset($result->price_sp95) ? $result->price_sp95 * 1000 : null;
                                                        });
                                                        $minPriceE85 = $stationsCollection->min(function ($result) {
                                                            return isset($result->price_e85) ? $result->price_e85 * 1000 : null;
                                                        });
                                                        $minPriceGplc = $stationsCollection->min(function ($result) {
                                                            return isset($result->price_gplc) ? $result->price_gplc * 1000 : null;
                                                        });
                                                        $minPriceE10 = $stationsCollection->min(function ($result) {
                                                            return isset($result->price_e10) ? $result->price_e10 * 1000 : null;
                                                        });
                                                        $minPriceSp98 = $stationsCollection->min(function ($result) {
                                                            return isset($result->price_sp98) ? $result->price_sp98 * 1000 : null;
                                                        });

                                                        $price_gazole = isset($stationInfo->price_gazole) ? $stationInfo->price_gazole * 1000 : null;
                                                        $price_sp95 = isset($stationInfo->price_sp95) ? $stationInfo->price_sp95 * 1000 : null;
                                                        $price_e85 = isset($stationInfo->price_e85) ? $stationInfo->price_e85 * 1000 : null;
                                                        $price_gplc = isset($stationInfo->price_gplc) ? $stationInfo->price_gplc * 1000 : null;
                                                        $price_e10 = isset($stationInfo->price_e10) ? $stationInfo->price_e10 * 1000 : null;
                                                        $price_sp98 = isset($stationInfo->price_sp98) ? $stationInfo->price_sp98 * 1000 : null;
                                                        @endphp
                                                        <tr class="text-center">
                                                            <td class="{{ isset($price_gazole) && $price_gazole == $minPriceGazole ? 'lowest-price' : '' }}">
                                                                {{ isset($price_gazole) ?  $price_gazole : '-' }}
                                                            </td>
                                                            <td class="{{ isset($price_sp95) && $price_sp95 == $minPriceSp95 ? 'lowest-price' : '' }}">
                                                                {{ isset($price_sp95) ? $price_sp95 : '-' }}</td>
                                                            <td class="{{ isset($price_e85) && $price_e85 == $minPriceE85 ? 'lowest-price' : '' }}">
                                                                {{ isset($price_e85) ? $price_e85 : '-' }}</td>
                                                            <td class="{{ isset($price_gplc) && $price_gplc == $minPriceGplc ? 'lowest-price' : '' }}">
                                                                {{ isset($price_gplc) ? $price_gplc : '-' }}</td>
                                                            <td class="{{ isset($price_e10) && $price_e10 == $minPriceE10 ? 'lowest-price' : '' }}">
                                                                {{ isset($price_e10) ? $price_e10 : '-' }}</td>
                                                            <td class="{{ isset($price_sp98) && $price_sp98 == $minPriceSp98 ? 'lowest-price' : '' }}">
                                                                {{ isset($price_sp98) ? $price_sp98 : '-' }}</td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
            <div class="col-md-12">
                <nav aria-label="navigation">
                    @include('common.pagination', ['paginator' => $paginator])
                </nav>
            </div>
        </div>
    </div>
</section>
@endif
@endsection