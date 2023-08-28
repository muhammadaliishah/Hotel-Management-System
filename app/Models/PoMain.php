<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoMain extends Model
{
    use HasFactory;
    protected $primaryKey='poMainId';
    public $table='po_main';
    protected $fillable = [
        'orderId',
        'vendorId',
        'orderedDate'
    ];
}
