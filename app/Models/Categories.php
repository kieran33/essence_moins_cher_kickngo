<?php

namespace App\Models;
use App\Models\Listings;
use App\Models\SubCategories;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category_icon','category_name', 'category_slug'];


	public $timestamps = false;
  
	//  public function subcategories()
	//  {
	// 	return $this->belongsToMany(SubCategories::class);
	//  }

    public function subcategories()
    {
        return $this->belongsToMany(SubCategories::class, 'category_subcategory', 'category_id', 'subcategory_id');
    }
    
	public function listings() {
		return $this->hasMany('App\Models\Listings');
	}
	
	public static function getCategoryInfo($id) 
    { 
		return Categories::find($id);
	}
	// public static function getSubCategories($id)
	// {
	// 	// return SubCategories::where('cat_id',$id)->orderBy('sub_category_name')->get();
	// 	return SubCategories::find($id);
	// }
	public static function countCategoryListings($id) 
    { 
		return Listings::where(['cat_id' => $id,'status' => '1'])->count();
	}

}
