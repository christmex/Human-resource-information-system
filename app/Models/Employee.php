<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fullname',
        'id_card',
        'place_of_birth',
        'date_of_birth',
        'sex',
        'religion_id',
        'highest_certificate',
        'start_working',
        // 'employment_status_id',
        'end_contract',
        'description',
        // 'department_id',
        // 'school_level_id'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }

    public function Religion()
    {
        return $this->belongsTo('App\Models\Religion', 'religion_idd','id');
    }

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
