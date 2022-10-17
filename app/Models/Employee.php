<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'fullname',
        'id_card',
        'place_of_birth',
        'date_of_birth',
        'start_working',
        // 'employment_status_id',
        'end_contract',
        'description',
        // 'department_id',
        // 'school_level_id'
    ];

    // public function EmploymentStatus()
    // {
    //     return $this->belongsTo('App\Models\EmploymentStatus', 'employment_status_id','id');
    // }

    // public function Department()
    // {
    //     return $this->belongsTo('App\Models\Department', 'department_id','id');
    // }

    // public function SchoolLevel()
    // {
    //     return $this->belongsTo('App\Models\SchoolLevel', 'school_level_id','id');
    // }

}