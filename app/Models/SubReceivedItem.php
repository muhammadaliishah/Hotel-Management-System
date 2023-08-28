<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubReceivedItem extends Model
{
    use HasFactory;
    protected $primaryKey='subRItemId';
    public $timestamps = false;
    public $table='sub_ritems';
    protected $fillable = [
        'mRItemId',
        'poSubItemId',
        'sRItemId',
        'sRQuantity',
        'sRPrice',
        'expiryDate'
    ];
}
