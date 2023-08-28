<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoBill extends Model
{
    use HasFactory;
    public $table='po_bills';
    protected $primaryKey='bill_Id';
    public $timestamps = false;
    protected $fillable = [
        'invoice_Id',
        'bill_paid',
        'bill_details',
        'payment_date'
    ];

  public function invoice()
    {
       return $this->belongsTo('App\Models\MainReceivedItem');
    }
}
