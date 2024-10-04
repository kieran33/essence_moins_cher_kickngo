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
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
class ListingsController extends Controller
{ 
    public function __construct()
    {
        $this->pagination_limit=12;
          
    }
    
    public function submit_listing()
    { 
        
        if(!Auth::check())
        {
            Session::flash('error_flash_message', trans('words.access_denied'));
            return redirect('login');            
        }

        //Check Plan Exp
        if(Auth::User()->usertype =="User")
        {   
            $user_id=Auth::User()->id;

            $user_info = User::findOrFail($user_id);
            $user_plan_id=$user_info->plan_id;
            $user_plan_exp_date=$user_info->exp_date;

            if($user_plan_id==0 OR strtotime(date('m/d/Y'))>$user_plan_exp_date)
            {      
                return redirect('pricing');
            }
        }

        //Check Limit
        $user_id = Auth::User()->id;
        $user_plan_id = Auth::User()->plan_id;

        $plan_info = SubscriptionPlan::findOrFail($user_plan_id);
        $plan_listing_limit=$plan_info->plan_listing_limit;

        $listings = Listings::where('user_id',$user_id)->count();
 
        if($listings >= $plan_listing_limit)
        {
            Session::flash('error_flash_message', trans('words.limit_reached'));

            return redirect('dashboard');
        }

        $categories = Categories::orderBy('category_name')->get();

        $locations = Location::orderBy('location_name')->get();

        return view('pages.listings.addeditlisting',compact('categories','locations'));
    }

    public function addnew(Request $request)
    { 
        
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(                      
                'title' => 'required',
                'description' => 'required',
                'category' => 'required',
                'sub_category' => 'required',
                'featured_image' => 'mimes:jpg,jpeg,gif,png'
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $listings = Listings::findOrFail($inputs['id']);

        }else{

            $listings = new Listings;

        }
 
        $listing_slug = Str::slug($inputs['title'], "-");
        
        //Featured image
        $featured_image = $request->file('featured_image');
         
        if($featured_image){
            
            \File::delete(public_path() .'/upload/listings/'.$listings->featured_image.'-b.jpg');
            \File::delete(public_path() .'/upload/listings/'.$listings->featured_image.'-s.jpg');
            
            $tmpFilePath = public_path('upload/listings/');          
             
            $hardPath = substr($listing_slug,0,100).'_'.time();
            
            $img = Image::make($featured_image);

            $img->save($tmpFilePath.$hardPath.'-b.jpg');
            
            //$img->fit(300, 300)->save($tmpFilePath.$hardPath. '-s.jpg');

            $img->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($tmpFilePath.$hardPath. '-s.jpg');

            $listings->featured_image = $hardPath;
             
        }

        if(empty($inputs['id'])){
           
            $listings->user_id = Auth::User()->id;
        } 
 
        $listings->title = $inputs['title']; 
        $listings->listing_slug = $listing_slug;
        $listings->cat_id = $inputs['category'];
        $listings->sub_cat_id = $inputs['sub_category'];
        $listings->description = $inputs['description'];
        $listings->address = $inputs['address'];
        //$listings->location_id = $inputs['location'];
        $listings->google_map_code = $inputs['google_map_code'];    
        
        
        if(checkUserPlanFeatures(Auth::User()->id,'plan_featured_option')==1) 
        {
            $listings->featured_listing = $inputs['featured_listing'];   
        }
        
        if(checkUserPlanFeatures(Auth::User()->id,'plan_amenities_option')==1) 
        {
            $listings->amenities = $inputs['amenities'];
        }

        if(checkUserPlanFeatures(Auth::User()->id,'plan_business_hours_option')==1) 
        {        
            $listings->working_hours_mon = $inputs['working_hours_mon'];
            $listings->working_hours_tue = $inputs['working_hours_tue'];
            $listings->working_hours_wed = $inputs['working_hours_wed'];
            $listings->working_hours_thurs = $inputs['working_hours_thurs'];
            $listings->working_hours_fri = $inputs['working_hours_fri'];
            $listings->working_hours_sat = $inputs['working_hours_sat'];
            $listings->working_hours_sun = $inputs['working_hours_sun'];
        }
       
        if(checkUserPlanFeatures(Auth::User()->id,'plan_video_option')==1) 
        {
            $listings->video = $inputs['video'];
        }        

          
        $listings->save();
        

        if(checkUserPlanFeatures(Auth::User()->id,'plan_gallery_images_option')==1) 
        {

                //News Gallery image
                $listing_gallery_files = $request->file('gallery_file');
                
                //$file_count = count($listing_gallery_files);
                
                if($request->hasFile('gallery_file'))
                {

                    if(!empty($inputs['id']))
                    {

                        foreach($listing_gallery_files as $file) {
                            
                            $listing_gallery_obj = new ListingGallery;
                            
                            $tmpFilePath = public_path('upload/gallery/');           
                            
                            $hardPath = substr($listing_slug,0,100).'_'.rand(0,9999).'-b.jpg';
                            
                            $g_img = Image::make($file);

                            $g_img->save($tmpFilePath.$hardPath);
                            

                            $listing_gallery_obj->listing_id = $inputs['id'];
                            $listing_gallery_obj->image_name = $hardPath;
                            $listing_gallery_obj->save();
                            
                        }

                    }
                    else
                    {   
                        foreach($listing_gallery_files as $file) {
                            
                            $listing_gallery_obj = new ListingGallery;
                            
                            $tmpFilePath = public_path('upload/gallery/');           
                            
                            $hardPath = substr($listing_slug,0,100).'_'.rand(0,9999).'-b.jpg';
                            
                            $g_img = Image::make($file);

                            $g_img->save($tmpFilePath.$hardPath);
                            
                            $listing_gallery_obj->listing_id = $listings->id;
                            $listing_gallery_obj->image_name = $hardPath;
                            $listing_gallery_obj->save();
                            
                        }
                    }
                }

        }

        if(!empty($inputs['id'])){

            Session::flash('flash_message', trans('words.chanages_saved'));

            return \Redirect::back();
        }else{

            Session::flash('flash_message', trans('words.listing_added_success'));

            return \Redirect::back();

        }            
        
         
    }

    public function editlisting($id)    
    {     
           
         if(!Auth::check())
         {

            Session::flash('error_flash_message', trans('words.access_denied'));
            return redirect('login');
        
         }    

          //Check Plan Exp
        if(Auth::User()->usertype =="User")
        {   
            $user_id=Auth::User()->id;

            $user_info = User::findOrFail($user_id);
            $user_plan_id=$user_info->plan_id;
            $user_plan_exp_date=$user_info->exp_date;

            if($user_plan_id==0 OR strtotime(date('m/d/Y'))>$user_plan_exp_date)
            {      
                return redirect('pricing');
            }
        }          
           
          $listing = Listings::findOrFail($id);
            
         if($listing->user_id!=Auth::User()->id and Auth::User()->usertype!="Admin")
         {

            Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('dashboard');
        
         }

          
          $categories = Categories::orderBy('category_name')->get(); 

          $subcategories = SubCategories::where('cat_id',$listing->cat_id)->orderBy('sub_category_name')->get();

          $locations = Location::orderBy('location_name')->get();

          $listing_gallery_images = ListingGallery::where('listing_id',$listing->id)->orderBy('id')->get();


          return view('pages.listings.addeditlisting',compact('listing','categories','subcategories','locations','listing_gallery_images'));
        
    }    
    
    public function delete($listing_id)
    {   

        $listing = Listings::findOrFail($listing_id);


         if($listing->user_id!=Auth::User()->id and Auth::User()->usertype!="Admin")
         {

            Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('dashboard');
        
         }


        if(Auth::User()->usertype=="Admin" or Auth::User()->usertype=="User")
        {
             

            $listing_gallery_obj = ListingGallery::where('listing_id',$listing->id)->get();
            
            foreach ($listing_gallery_obj as $listing_gallery) {
                
                \File::delete('upload/gallery/'.$listing_gallery->image_name);
                \File::delete('upload/gallery/'.$listing_gallery->image_name);
                
                $listing_gallery_del = ListingGallery::findOrFail($listing_gallery->id);
                $listing_gallery_del->delete(); 

                
            }   

            
            \File::delete(public_path() .'/upload/listings/'.$listing->featured_image.'-b.jpg');
            \File::delete(public_path() .'/upload/listings/'.$listing->featured_image.'-s.jpg');    

            $listing->delete();

            Session::flash('flash_message', trans('words.deleted'));

            return redirect()->back();
        }
        else
        {
            Session::flash('error_flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        
        }
    }

    public function gallery_image_delete($id)
    {
        
        $listing_gallery_obj = ListingGallery::findOrFail($id);
        
        \File::delete('upload/gallery/'.$listing_gallery_obj->image_name);
         
        $listing_gallery_obj->delete(); 

        Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }


    public function ajax_subcategories($cat_id){ 
        
               
        $subcategories = SubCategories::where('cat_id',$cat_id)->orderBy('sub_category_name')->get();

         
        return view('pages.listings.ajax_subcategories',compact('subcategories'));
    } 

    public function storePosition(Request $request){
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
    
        // Stockez la position dans la session
        session(['latitude' => $latitude, 'longitude' => $longitude]);
    
        return response()->json(['status' => 'success']);
    }





    public function listings_closetome(Request $request){

        //$liste_stations = Categories::all();

        $latitude = session('latitude');
        $longitude = session('longitude');

        if (empty($latitude) || empty($longitude)) {
            $village = null;
        } else {
            $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$latitude}&lon={$longitude}&zoom=18&addressdetails=1";
            $client = new \GuzzleHttp\Client();
    
            try {
                $response = $client->request('GET', $url);
                $data = json_decode($response->getBody()->getContents());
                $village = $data->address->village ?? null;
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                Log::error('Client error: ' . $e->getMessage(), ['url' => $url]);
                if ($e->getCode() == 403) {
                    $village = null;
                } else {
                    throw $e; 
                }
            }
        }

        $radius = 10000; // Rayon en mètres
        $url = "https://public.opendatasoft.com/api/records/1.0/search/?dataset=prix_des_carburants_j_7&geofilter.distance={$latitude},{$longitude},20000&rows=50";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // Force HTTP/1.1
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
        ));
        $response = curl_exec($ch);
        if(curl_errno($ch)){
            echo 'Erreur cURL : ' . curl_error($ch);
        }
        curl_close($ch);
        $stations = json_decode($response);
        $stations = response()->json($stations);
        return view('pages.listings.proximite_listings',compact('longitude', 'latitude', 'stations','village'));
    }






    
    public function getStations(Request $request){
        $latitude = session('latitude');
        $longitude = session('longitude');

        if (empty($latitude) || empty($longitude)) {
            $village = null;
        } else {
            $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$latitude}&lon={$longitude}&zoom=18&addressdetails=1";
            $client = new \GuzzleHttp\Client();
            try {
                $response = $client->request('GET', $url);
                $data = json_decode($response->getBody()->getContents());
                $village = $data->address->village ?? null;
            } catch (\GuzzleHttp\Exception\ServerException $e) {
                // Log the error message for debugging
                Log::error("Server error when trying to get location: " . $e->getMessage());
            
                // Set $village to null if the request fails
                $village = null;
            }
        }
        $radius = 10000;
        $url = "https://public.opendatasoft.com/api/records/1.0/search/?dataset=prix_des_carburants_j_7&geofilter.distance={$latitude},{$longitude},20000&rows=50";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // Force HTTP/1.1
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
        ));
        $response = curl_exec($ch);
        if(curl_errno($ch)){
            echo 'Erreur cURL : ' . curl_error($ch);
        }
        curl_close($ch);
        $stations = $response;
        return response()->json(['stations' => $stations]);
    }

}
