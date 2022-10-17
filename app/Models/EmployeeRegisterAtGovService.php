<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRegisterAtGovService extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'goverment_service_id',
        'register_at'
    ];

    public function Employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id','id');
    }

    public function GovermentService()
    {
        return $this->belongsTo('App\Models\GovermentService', 'goverment_service_id','id');
    }
}
