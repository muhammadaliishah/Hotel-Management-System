<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $table='employees';
    protected $primaryKey='emp_Id';
    public $timestamps = false;
    protected $fillable = [
        'emp_fname',
        'emp_lname',
        'emp_gen',
        'emp_contact',
        'pos_id',
        'emp_address',
        'emp_status',
        'joining_date',
        'leaving_date'
    ];
}
