<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;
    public $table='itemcategories';
    protected $primaryKey='categoryId';

    protected $fillable = [
        'catgeoryName',
        'categoryDetail',
        'parentCategory',
        'categoryAbb'
    ];

    public function item()
         {
            return $this->hasMany('App\Models\StoreItem');
         }
}
