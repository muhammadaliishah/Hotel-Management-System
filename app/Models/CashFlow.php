<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    use HasFactory;
    protected $primaryKey='cashflowId';
    public $table='cashflow';
    protected $fillable = [
        'cf_catId',
        'cfdetails',
        'cfexpense'
    ];

      public function category()
        {
           return $this->belongsTo('App\Models\CashFlowCategory');
        }
}
