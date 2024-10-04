<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesSubCategories extends Model
{
    use HasFactory;
    protected $fillable = ['subcategories_id','categories_id;'];

    // protected $fillable = ['subcategory_id','category_id;'];

    public $timestamps = false;
}
