<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'barcode',
        'price',
        'quantity',
        'status',
        'categoryId'
    ];

      public function category()
        {
           return $this->belongsTo('App\Models\ProductCategory');
        }
}
