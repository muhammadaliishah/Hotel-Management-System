<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlowCategory extends Model
{
    use HasFactory;
    public $table='cf_categories';
    protected $primaryKey='cf_catId';

    protected $fillable = [
        'cf_catName',
        'cf_catDetail',
        'cf_catParent',
        'cf_catAbb'
    ];

    public function flow()
         {
            return $this->hasMany('App\Models\CashFlow');
         }
}
