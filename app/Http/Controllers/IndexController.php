<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Categories;
use App\Models\Listings;
use App\Models\SubscriptionPlan;
use App\Models\SubCategories;
use App\Http\Controllers\ListingsController;

use Session;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\Crypt;

class IndexController extends Controller
{

    public function index()
    { 

        $featured_listings = Listings::where('status','1')->where('featured_listing','1')->orderBy('id','desc')->paginate(8);

        $sub_categories_listings = SubCategories::all();

        $sub_cat_list2 = SubCategories::all();

        $randomSubCategories = SubCategories::inRandomOrder()->limit(16)->get();

        $cat_info = Categories::all();
        
        return view('pages.index', compact('featured_listings', 'sub_categories_listings', 'sub_cat_list2', 'randomSubCategories', 'cat_info'));
    }
 
 
    
    public function legal()
    {
        return view('pages.extra.legal');
    }
    
    public function about_us()
    { 
                  
        return view('pages.extra.about');
    }
 
    public function termsandconditions()
    { 
                  
        return view('pages.extra.terms');
    }

    public function privacypolicy()
    { 
                  
        return view('pages.extra.privacy');
    }

    public function contact_us()
    {        
        return view('pages.extra.contact');
    }

    public function contact_send(Request $request)
    { 
        
        $data =  \Request::except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(                
                'name' => 'required',
                'email' => 'required|email|max:75',
                'calculation' => 'required|in:5'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
            $data = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],           
            'subject' => $inputs['subject'],
            'user_message' => $inputs['message'],
             );

            $subject=$inputs['subject'];
            
           $from_email= getenv("MAIL_FROM_ADDRESS"); 

            try{ 

            \Mail::send('emails.contact', $data, function ($message) use ($subject,$from_email){

                $message->from($from_email, getcong('site_name'));

                $message->to(getcong('site_email'))->subject($subject);

            });

            }catch (\Throwable $e) {
                
                \Log::info($e->getMessage()); 
                
                \Session::flash('flash_message',$e->getMessage());
                return \Redirect::back();
                        
            }
             
            \Session::flash('flash_message', trans('words.contact_msg'));
            return \Redirect::back();
         
    }    

    public function autocompleteCat(Request $request)
    {
        $datas = Categories::select("id", "category_name", "category_slug")
            ->where("category_name", "LIKE", "%{$request->input('query')}%")
            ->orderBy('category_name')
            ->get();

        return response()->json($datas);
    }

    public function alreadyInstalled()
    {   
         
        return file_exists(base_path('/public/.lic'));
    }
 
      
}