<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\Settings;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 

class SettingsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
         
    }
    public function settings()
    { 
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
        
        $settings = Settings::findOrFail('1');
        
        return view('admin.pages.settings',compact('settings'));
    }	 
    
    public function settingsUpdates(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	    $rule=array(
		        'site_name' => 'required',
		        'site_email' => 'required',
		        'site_description' => 'required',
		        'currency_code' => 'required'
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
	    

	    $inputs = $request->all();

		 
		$site_logo = $request->file('site_logo');
		
		$icon_favicon = $request->file('site_favicon');
		 
		//Logo
		 
        if($site_logo){
            
           // $icon->move(public_path().'/upload/', 'logo.png');
           $tmpFilePath = public_path('upload/');

            $hardPath =  'site_logo'.'-'.time().'.'.$site_logo->getClientOriginalExtension();

            $img = Image::make($site_logo);

            $img->save($tmpFilePath.$hardPath);
 
            $settings->site_logo = $hardPath;             
              
        }       
        
        //Favicon
        if($icon_favicon){     	
        	             
            $tmpFilePath = public_path('upload/');			
			 
            $hardPath =  'favicon'.'-'.time().'.'.$icon_favicon->getClientOriginalExtension();

			
            $img = Image::make($icon_favicon);

            $img->fit(16, 16)->save($tmpFilePath.$hardPath); 
             
            $settings->site_favicon = $hardPath;
                        
        }

		//Footer Logo
		$site_footer_logo = $request->file('site_footer_logo');
		 
        
        if($site_footer_logo){
            $tmpFilePath = public_path('upload/');

            $hardPath =  'footer_logo'.'-'.time().'.'.$site_footer_logo->getClientOriginalExtension();

            $img = Image::make($site_footer_logo);

            $img->save($tmpFilePath.$hardPath);
 
            $settings->site_footer_logo = $hardPath;
        }
       
		putPermanentEnv('APP_TIMEZONE', $inputs['time_zone']);

		$settings->time_zone = $inputs['time_zone'];
        $settings->styling = $inputs['styling']; 
        $settings->currency_code = $inputs['currency_code'];
		 
		$settings->site_name = $inputs['site_name']; 
		
		$settings->site_email = $inputs['site_email'];
		$settings->site_description = $inputs['site_description']; 		 
 
		$settings->facebook_url = $inputs['facebook_url'];
		$settings->twitter_url = $inputs['twitter_url'];
		$settings->instagram_url = $inputs['instagram_url'];
		$settings->linkedin_url = $inputs['linkedin_url'];		

		$settings->site_footer_text = $inputs['site_footer_text'];
		$settings->site_copyright = $inputs['site_copyright'];
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

	public function smtp_settings(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		putPermanentEnv('MAIL_HOST', $inputs['smtp_host']);
        putPermanentEnv('MAIL_PORT', $inputs['smtp_port']);
        putPermanentEnv('MAIL_USERNAME', $inputs['smtp_email']);
        putPermanentEnv('MAIL_PASSWORD', $inputs['smtp_password']);
        putPermanentEnv('MAIL_ENCRYPTION', $inputs['smtp_encryption']);

        putPermanentEnv('MAIL_FROM_ADDRESS', $inputs['smtp_email']);
         
        $settings->smtp_host = $inputs['smtp_host'];
        $settings->smtp_port = $inputs['smtp_port'];
        $settings->smtp_email = $inputs['smtp_email'];
        $settings->smtp_password = $inputs['smtp_password'];
        $settings->smtp_encryption = $inputs['smtp_encryption'];		 
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

	public function social_login_settings(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		$google_redirect=\URL::to('auth/google/callback');
        $facebook_redirect=\URL::to('auth/facebook/callback');

        putPermanentEnv('GOOGLE_CLIENT_DI', $inputs['google_client_id']);
        putPermanentEnv('GOOGLE_SECRET', $inputs['google_client_secret']);
        putPermanentEnv('GOOGLE_REDIRECT', $google_redirect);

        putPermanentEnv('FB_APP_ID', $inputs['facebook_app_id']);
        putPermanentEnv('FB_SECRET', $inputs['facebook_client_secret']);
        putPermanentEnv('FB_REDIRECT', $facebook_redirect);
        
        $settings->google_login = $inputs['google_login'];
        $settings->google_client_id = $inputs['google_client_id'];
        $settings->google_client_secret = $inputs['google_client_secret'];
        $settings->google_redirect = $google_redirect;

        $settings->facebook_login = $inputs['facebook_login'];
        $settings->facebook_app_id = $inputs['facebook_app_id'];
        $settings->facebook_client_secret = $inputs['facebook_client_secret'];
        $settings->facebook_redirect = $facebook_redirect;
		 
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
    
    public function homepage_settings(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		 

        $home_bg_image = $request->file('home_bg_image');
		
		//Home page bg image
        if($home_bg_image){
        	
        	 
            $tmpFilePath = public_path('upload/');	
            
            $hardPath =  'home_bg_image'.'-'.time().'.'.$home_bg_image->getClientOriginalExtension();

            $img = Image::make($home_bg_image);

            $img->save($tmpFilePath.$hardPath);
 
            $settings->home_bg_image = $hardPath;			 
			  
        }
		 
		$settings->home_title = $inputs['home_title'];
		$settings->home_sub_title = $inputs['home_sub_title']; 

		if(isset($inputs['home_categories_ids']))
         {
            $settings->home_categories_ids = implode(',', $inputs['home_categories_ids']);
         }
         else
         {
            $settings->home_categories_ids = null;
         }

 		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
 
    public function aboutus_settings(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		$settings->about_title = $inputs['about_title']; 
		$settings->about_description = $inputs['about_description'];
		 
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

    public function contactus_settings(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		$settings->contact_title = $inputs['contact_title']; 
		$settings->contact_address = $inputs['contact_address'];
		$settings->contact_email = $inputs['contact_email'];
		$settings->contact_number = $inputs['contact_number'];
		 
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

    public function terms_of_service(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		$settings->terms_of_title = $inputs['terms_of_title']; 
		$settings->terms_of_description = $inputs['terms_of_description'];
		 
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
    
    public function privacy_policy(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		$settings->privacy_policy_title = $inputs['privacy_policy_title']; 
		$settings->privacy_policy_description = $inputs['privacy_policy_description'];
		 
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }

    public function addthisdisqus(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		$settings->addthis_share_code = $inputs['addthis_share_code']; 
		$settings->disqus_comment_code = $inputs['disqus_comment_code'];
		$settings->facebook_comment_code = $inputs['facebook_comment_code'];
		 		  
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
    
    public function headfootupdate(Request $request)
    {  
    		 
    	$settings = Settings::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	     
	    $inputs = $request->all();
		
		 
		$settings->site_header_code = $inputs['site_header_code']; 
		$settings->site_footer_code = $inputs['site_footer_code'];
		 
		  
		 
	    $settings->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    } 
    	
}
