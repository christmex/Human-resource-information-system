<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovermentService extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'goverment_service_name',
        'required_employment_status_id'
    ];

    public function EmploymentStatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus', 'required_employment_status_id','id');
    }
}
