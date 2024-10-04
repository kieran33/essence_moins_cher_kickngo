<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\Listings;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Location;
use App\Models\SubscriptionPlan;
use App\Models\PaymentTransaction;
 
use App\Http\Requests;
use Illuminate\Http\Request;


class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
         
    }
    public function index()
    { 
    	 if(Auth::user()->usertype=='Admin')	
          {  
        		$categories = Categories::count(); 
        		$subcategories = SubCategories::count(); 
        	 	$location = Location::count(); 
        	 	$users = User::where('usertype', 'User')->count();
                $listings = Listings::count();

                $plans = SubscriptionPlan::count();
                $transactions = PaymentTransaction::count();   

            return view('admin.pages.dashboard',compact('categories','subcategories','location','users','listings','plans','transactions'));

	      }
   
    	
        
    }
	
	 
    	
}
