<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $table='product_categories';
    protected $primaryKey='categoryId';

    protected $fillable = [
        'catgeoryName',
        'categoryDetail',
        'parentCategory',
        'categoryAbb'
    ];

    public function products()
         {
            return $this->hasMany('App\Models\Product');
         }
}
