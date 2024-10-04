<?php

namespace App\Models;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    protected $table = 'listings';

    protected $fillable = ['user_id','cat_id','sub_cat_id','location_id','featured_listing','title','listing_slug','description','address','video','google_map_code','amenities','working_hours_mon','working_hours_tue','working_hours_wed','working_hours_thurs','working_hours_fri','working_hours_sat','working_hours_sun','featured_image','review_avg','status'];

    public function category()
    {
        return $this->belongsTo('App\Models\Categories', 'cat_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategories::class, 'listings_subcategories', 'listing_id', 'subcategory_id');
    }
    
    public static function getListingname($id) 
    { 
        $listings=Listings::find($id);

        return $listings->title;
    }
 
	//public $timestamps = false;
   
    public function scopeSearchByKeyword($query, $keyword, $sub_cat_id)
    {
        if ($keyword != '' and $sub_cat_id != '') {
            $query->where(function ($query) use ($keyword, $sub_cat_id) {
                $query->where("title", "LIKE", "%$keyword%")
                    ->where("sub_cat_id", "$sub_cat_id")
                    ->where("status", "1");                     
            });
        }
        else
        {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE", "%$keyword%")
                ->where("status", "1");
            });
        }
        return $query;
    }

    public function scopeSearchByFilter($query, $category,$rating)
    {
        if ($category!='' and $rating!='') {
            $query->where(function ($query) use ($category,$rating) {
                $query->where("cat_id", "$category")
                    ->where("review_avg", "$rating")
                    ->where("status", "1");                     
            });
        }
        elseif ($category!='') {
            $query->where(function ($query) use ($category) {
                $query->where("cat_id", "$category")
                ->where("status", "1");
                                    
            });
        }
        else
        {
             
            $query->where(function ($query) use ($rating) {
                $query->where("review_avg", "$rating")->where("status", "1");
                                    
            });
        }
        return $query;
    }
}
