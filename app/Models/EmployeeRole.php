<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class EmployeeRole extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'role_id',
        'department_id',
        'school_level_id',
        'employment_status_id',
        'start',
        'end'
    ];

    public function Employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id','id');
    }

    // Buat untuk role extedn role dari spatie permissions
    public function Role()
    {
        return $this->belongsTo(SpatieRole::class, 'role_id','id');
    }

    public function EmploymentStatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus', 'employment_status_id','id');
    }

    public function Department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id','id');
    }

    public function SchoolLevel()
    {
        return $this->belongsTo('App\Models\SchoolLevel', 'school_level_id','id');
    }
}
