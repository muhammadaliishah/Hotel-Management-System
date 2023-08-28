<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTransaction extends Model
{
    use HasFactory;
    public $table='emp_loans';
    protected $primaryKey='loanId';
    public $timestamps = false;
    protected $fillable = [
        'emp_Id',
        'transaction_amount',
        'payment_nature',
        'transaction_date'
    ];
}
