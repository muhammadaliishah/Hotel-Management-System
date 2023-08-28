<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    use HasFactory;
    protected $primaryKey='itemId';
    public $table='storeitems';
    protected $fillable = [
        'itemName',
        'description',
        'image',
        'barcode',
        'price',
        'status',
        'categoryId',
        'minQuantity',
        'unitOfMeasurement',
        'quantity'
    ];

      public function category()
        {
           return $this->belongsTo('App\Models\ItemCategory');
        }
}
