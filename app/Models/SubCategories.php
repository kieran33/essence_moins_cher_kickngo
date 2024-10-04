<?php

namespace App\Models;
use App\Models\Listings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = ['sub_category_name', 'sub_category_slug'];


	public $timestamps = false;
	public function news()
    {
        return $this->hasMany('App\News', 'cat_id');
    }
	
	public static function getSubCategoryInfo($id) 
    { 
		return SubCategories::find($id);
	}

	public static function countSubCategory($id) 
    { 
		return SubCategories::where(['cat_id' => $id])->count();
	}

	public static function countSubCategoryListings($id) 
    { 
		return Listings::where(['sub_cat_id' => $id,'status' => '1'])->count();
	}
}
