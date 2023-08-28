<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedItem extends Model
{
    use HasFactory;
    protected $primaryKey='itemId ';
    public $table='receiveditems';
    protected $fillable = [
        'itemId',
        'rquantity',
        'rprice',
        'expiryDate'
    ];
}
