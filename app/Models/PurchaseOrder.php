<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $primaryKey='poItemId';
    public $timestamps = false;
    public $table='purchaseorders';
    protected $fillable = [
        'itemId',
        'pMainId',
        'quantity',
        'description',
        'price'
    ];
}
