<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    
    Route::get('/', [ 'as' => 'login', 'uses' => 'IndexController@index']);
    
    Route::post('login', 'IndexController@postLogin');
    Route::get('logout', 'IndexController@logout');
     
    Route::get('dashboard', 'DashboardController@index');
    
    Route::get('profile', 'AdminController@profile');   
    Route::post('profile', 'AdminController@updateProfile');    
    Route::post('profile_pass', 'AdminController@updatePassword');

    
    Route::get('settings', 'SettingsController@settings');  
    Route::post('settings', 'SettingsController@settingsUpdates');  
    Route::post('smtp_settings', 'SettingsController@smtp_settings');  
    Route::post('social_login_settings', 'SettingsController@social_login_settings');  
    Route::post('homepage_settings', 'SettingsController@homepage_settings');     
    Route::post('aboutus_settings', 'SettingsController@aboutus_settings');
    Route::post('contactus_settings', 'SettingsController@contactus_settings');
    Route::post('terms_of_service', 'SettingsController@terms_of_service');
    Route::post('privacy_policy', 'SettingsController@privacy_policy');
    Route::post('addthisdisqus', 'SettingsController@addthisdisqus');   
    Route::post('headfootupdate', 'SettingsController@headfootupdate');
      
    
    Route::get('users', 'UsersController@userslist');   
    Route::get('users/adduser', 'UsersController@addeditUser'); 
    Route::post('users/adduser', 'UsersController@addnew'); 
    Route::get('users/adduser/{id}', 'UsersController@editUser');   
    Route::get('users/delete/{id}', 'UsersController@delete');  
    
     
    Route::get('ville', 'CategoriesController@categories');    
    Route::get('ville/addcategory', 'CategoriesController@addeditCategory'); 
    Route::get('ville/addcategory/{id}', 'CategoriesController@editCategory'); 
    Route::post('ville/addcategory', 'CategoriesController@addnew');   
    Route::get('ville/delete/{id}', 'CategoriesController@delete');


    Route::get('categories', 'SubCategoriesController@subcategories');   
    Route::get('categories/addsubcategory', 'SubCategoriesController@addeditSubCategory'); 
    Route::get('categories/addsubcategory/{id}', 'SubCategoriesController@editSubCategory'); 
    Route::post('categories/addsubcategory', 'SubCategoriesController@addnew');  
    Route::get('categories/delete/{id}', 'SubCategoriesController@delete');  
    Route::get('ajax_categories/{id}', 'SubCategoriesController@ajax_subcategories');


    Route::get('locations', 'LocationController@locations');    
    Route::get('locations/addlocation', 'LocationController@addeditLocation'); 
    Route::get('locations/addlocation/{id}', 'LocationController@editLocation');    
    Route::post('locations/addlocation', 'LocationController@addnew');  
    Route::get('locations/delete/{id}', 'LocationController@delete');

    Route::get('entreprise', 'ListingsController@listings');   
    Route::get('entreprise/featured_listing/{id}/{status}', 'ListingsController@featured_listing');
    Route::get('entreprise/status_listing/{id}/{status}', 'ListingsController@status_listing');
    Route::get('entreprise/delete_listing/{id}', 'ListingsController@delete');
    

    Route::get('plan', 'PlanController@plan_list');
    Route::get('plan/add', 'PlanController@add_plan');  
    Route::get('plan/edit/{id}', 'PlanController@edit_plan');
    Route::post('plan/addedit', 'PlanController@addnew');
    Route::get('plan/delete/{id}', 'PlanController@delete');

    Route::get('transaction', 'TransactionController@transaction_list');
    Route::get('income/daily', 'TransactionController@daily_income');
    Route::get('income/week', 'TransactionController@week_income');
    Route::get('income/month', 'TransactionController@month_income');
    Route::get('income/year', 'TransactionController@year_income');

    Route::get('payment_gateway', 'PaymentGatewayController@list');
    Route::get('payment_gateway/edit/{id}', 'PaymentGatewayController@edit');   
    Route::post('payment_gateway/paypal', 'PaymentGatewayController@paypal');
    Route::post('payment_gateway/stripe', 'PaymentGatewayController@stripe');
    Route::post('payment_gateway/razorpay', 'PaymentGatewayController@razorpay');
    Route::post('payment_gateway/paystack', 'PaymentGatewayController@paystack');
     
});

// Password reset link request routes...
/*Route::get('admin/password/email', 'Auth\PasswordController@getEmail');
Route::post('admin/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('admin/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('admin/password/reset', 'Auth\PasswordController@postReset');*/


Route::get('/', 'IndexController@index');


Route::get('a-propos', 'IndexController@about_us');
Route::get('conditions-generales', 'IndexController@termsandconditions');
Route::get('politique-confidentialite', 'IndexController@privacypolicy');
Route::get('legal', 'IndexController@legal');

Route::get('contact', 'IndexController@contact_us');
Route::post('contact_send', 'IndexController@contact_send');
Route::get('ville/search', 'CategoriesController@search')->name('categories.search');
Route::get('ville', 'CategoriesController@categories_list');


Route::get('/ville/{letter}', 'CategoriesController@categories_list_letter')->name('categories.categories_list_letter');

Route::get('ville/{cat_slug}/{cat_id}', 'CategoriesController@sub_categories_list');

Route::get('stations/{station_city}/{station_slug}/{id_station}', 'CategoriesController@single_station');

Route::get('marque/{marque_slug}/', 'CategoriesController@marque_list');
// Page près de chez vous
Route::get('a-proximite', 'ListingsController@listings_closetome');

Route::post('store-position', 'ListingsController@storePosition');

Route::get('/get-stations', 'ListingsController@getStations')->name('getStations');

Route::get('user_listings/{id}', 'ListingsController@user_listings');

Route::post('submit_review', 'ListingsController@submit_review');

Route::post('inquiry_send', 'ListingsController@inquiry_send');


Route::get('login', 'UserController@login');
Route::post('login', 'UserController@postLogin');

// Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
// Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

// Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
// Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

Route::get('register', 'UserController@register');
Route::post('register', 'UserController@postRegister');   

Route::get('dashboard', 'UserController@dashboard');
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@editprofile');
Route::get('logout', 'UserController@logout'); 

Route::post('phone_update', 'UserController@phone_update');
 
Route::get('password/email', 'Auth\ForgotPasswordController@forget_password');
Route::post('password/email', 'Auth\ForgotPasswordController@forget_password_submit');
Route::get('password/reset/{token}', 'Auth\ForgotPasswordController@reset_password');
Route::post('password/reset', 'Auth\ForgotPasswordController@reset_password_submit');

Route::get('submit_listing', 'ListingsController@submit_listing');
Route::post('submit_listing', 'ListingsController@addnew');
Route::get('edit_listing/{id}', 'ListingsController@editlisting');
Route::get('delete_listing/{id}', 'ListingsController@delete');
Route::get('listing/galleryimage_delete/{id}', 'ListingsController@gallery_image_delete');
Route::get('ajax_subcategories/{id}', 'ListingsController@ajax_subcategories');
 

Route::post('submit_review', 'ListingsController@submit_review');
Route::post('inquiry_send', 'ListingsController@inquiry_send');

Route::get('/autocompleteCat', 'IndexController@autocompleteCat')->name('autocompleteCat');


Route::get('/autocompleteCatCont', 'CategoriesController@autocompleteCatCont')->name('autocompleteCatCont');
Route::get('/autocomplete', 'IndexController@autocomplete')->name('autocomplete');


//Clear Cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Clear View cache
Route::get('/clear-view', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
}); 