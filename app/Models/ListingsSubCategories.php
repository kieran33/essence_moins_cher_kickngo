<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingsSubCategories extends Model
{
    use HasFactory;
    protected $fillable = ['subcategory_id','listing_id;'];

    // Nom de la table
    protected $table = 'listings_subcategories';

    public $timestamps = false;

    public static function getInfo($id) 
    { 
        return ListingsSubCategories::find($id);
    }
}