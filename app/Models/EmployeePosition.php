<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;
    public $table='employee_positions';
    protected $primaryKey='pos_id';
    protected $fillable = [
        'pos_type',
        'pos_name',
        'pos_status'
    ];
}
