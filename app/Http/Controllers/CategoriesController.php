<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Listings;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Location;
use App\Models\ListingGallery;
use App\Models\Reviews;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->pagination_limit=48;

    }
    public function autocompleteCatCont(Request $request)
    {
        $datas = Categories::select("id", "category_name")
            ->where("category_name", "LIKE", "%{$request->input('query')}%")
            ->orderBy('category_name')
            ->get();

        return response()->json($datas);
    }
    public function categories_list_letter($letter)
    {
        $letter = strtoupper($letter);
        $categoriesLetter = Categories::where('category_slug', 'LIKE', $letter.'%')->paginate($this->pagination_limit);

        return view('pages.listings.categories_list_letter', compact('categoriesLetter', 'letter'));

    }
    public function categories_list(Request $request,$letter = null)
    {
        $cat_list = Categories::orderBy('category_name')->paginate($this->pagination_limit);
        if ($letter) {
            $categories = Categories::where('category_name', 'LIKE', $letter.'%')->paginate(10);
        } else {
            $categories = Categories::paginate(10);
        }
        $autocomplete_data = $this->autocompleteCatCont($request)->getData();
        $departements = DB::table('categories')->distinct()->get(['category_departement']);
        $results = [];
        foreach ($departements as $departement) {
            $topCities = DB::table('listings')
                ->select('categories.category_nom_reel', 'categories.category_slug','categories.id', 'listings.cat_id', 'departements.nom_departement', DB::raw('count(*) as total'))
                ->join('categories', 'categories.id', '=', 'listings.cat_id')
                ->join('departements', 'departements.code_departement', '=', 'categories.category_departement')
                ->where('categories.category_departement', $departement->category_departement)
                ->groupBy('listings.cat_id', 'categories.category_nom_reel', 'categories.category_slug', 'categories.id', 'departements.nom_departement')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get();
            $results[$departement->category_departement] = $topCities;
        }
        return view('pages.listings.categories_list', compact('cat_list', 'autocomplete_data', 'results','categories'));
    }
   public function search(Request $request)
    {
        $search = $request->get('search');
        $categories = Categories::where('category_slug', 'like', '%' . $search . '%')->paginate(12);
        return view('pages.listings.categories_list', ['cat_list' => $categories]);
    }






    public function sub_categories_list($cat_slug,$cat_id)
    {
         $cat_info = Categories::findOrFail($cat_id);
         $categories_list = Categories::where('id', $cat_id)->with(['subcategories' => function ($query) use ($cat_id) {$query->where('cat_id', $cat_id);}])->get();
         $url = "https://public.opendatasoft.com/api/records/1.0/search/?dataset=prix_des_carburants_j_7&refine.city=" . strtoupper($cat_info->category_slug)."&rows=50";
         $ch = curl_init();
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             'Accept: application/json'
         ));
         $response = curl_exec($ch);
         if(curl_errno($ch)){
             echo 'Erreur cURL : ' . curl_error($ch);
         }
         curl_close($ch);
         $stations = json_decode($response);
         if ($stations->nhits == 0) {
             $url = "https://public.opendatasoft.com/api/records/1.0/search/?dataset=prix_des_carburants_j_7&geofilter.distance={$cat_info->longitude},{$cat_info->latitude},15000&rows=50";
    
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                 'Accept: application/json'
             ));
             $response = curl_exec($ch);
             if(curl_errno($ch)){
                 echo 'Erreur cURL : ' . curl_error($ch);
             }
             curl_close($ch);
             $stations = json_decode($response);
         }
 
         $urlProche = "https://public.opendatasoft.com/api/records/1.0/search/?dataset=prix_des_carburants_j_7&geofilter.distance={$cat_info->longitude},{$cat_info->latitude},15000&rows=15";
         $chProche = curl_init();
         curl_setopt($chProche, CURLOPT_URL, $urlProche);
         curl_setopt($chProche, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($chProche, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
         curl_setopt($chProche, CURLOPT_HTTPHEADER, array(
             'Accept: application/json'
         ));
         $responseProche = curl_exec($chProche);
         if(curl_errno($chProche)){
             echo 'Erreur cURL : ' . curl_error($chProche);
         }
         curl_close($chProche);
         $stationsProche = json_decode($responseProche);
         return view('pages.listings.sub_categories_list', compact('cat_info', 'categories_list', 'stations','stationsProche'));
     }






     
    public function single_station($cat_slug, $station_slug, $id_station)
    {
        $category = Categories::where('category_slug', $cat_slug)->get();
        $url = "https://public.opendatasoft.com/api/records/1.0/search/?dataset=prix_des_carburants_j_7&refine.id={$id_station}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
        ));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
        }
        curl_close($ch);
        $station = json_decode($response);
        $stationsProche = null;
        if (!empty($station->records) && property_exists($station->records[0], 'geometry') && property_exists($station->records[0]->geometry, 'coordinates')) {
            $urlProche = "https://public.opendatasoft.com/api/records/1.0/search/?dataset=prix_des_carburants_j_7&geofilter.distance={$station->records[0]->geometry->coordinates[1]},{$station->records[0]->geometry->coordinates[0]},15000&rows=6";
            $chProche = curl_init();
            curl_setopt($chProche, CURLOPT_URL, $urlProche);
            curl_setopt($chProche, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($chProche, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($chProche, CURLOPT_HTTPHEADER, array(
                'Accept: application/json'
            ));
            $response = curl_exec($chProche);
            if (curl_errno($chProche)) {
                echo 'Erreur cURL : ' . curl_error($chProche);
            }
            curl_close($chProche);
            $stationsProche = json_decode($response);
        } else {
            Log::error('API response does not contain expected records or geometry coordinates', ['url' => $url, 'response' => $response]);
        }
        return view('pages.listings.single_station', compact('cat_slug', 'station_slug', 'id_station', 'station', 'category', 'stationsProche'));
    }

    public function marque_list($marque_slug, Request $request){
        $page = $request->get('page', 1);
        $limit = 48;
        $offset = ($page - 1) * $limit; 
        $url = "https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/prix_des_carburants_j_7/records?where=%22{$marque_slug}%22&limit={$limit}&offset={$offset}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
        ));
        $response = curl_exec($ch);
        if(curl_errno($ch)){
            echo 'Erreur cURL : ' . curl_error($ch);
        }
        curl_close($ch);
        $marques = json_decode($response);
        $marque = $marque_slug;
        $paginator = new LengthAwarePaginator($marques->results, $marques->total_count, $limit, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        return view('pages.listings.marque_list', compact('marques', 'marque', 'paginator'));
    }

}
