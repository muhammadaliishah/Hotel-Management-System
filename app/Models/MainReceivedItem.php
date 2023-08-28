<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainReceivedItem extends Model
{
    use HasFactory;
    protected $primaryKey='mainRItemId';
    public $timestamps = false;
    public $table='main_ritems';
    protected $fillable = [
        'poRMainId',
        'invoiceNumber',
        'invoiceImage',
        'deliveryStatus',
        'receivedDate'
    ];
}
