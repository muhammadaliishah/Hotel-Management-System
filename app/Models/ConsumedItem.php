<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumedItem extends Model
{
    use HasFactory;
    protected $primaryKey='cItemId ';
    public $table='consumed_items';
    protected $fillable = [
        'itemId',
        'consumedDate',
        'cquantity'
    ];
}
