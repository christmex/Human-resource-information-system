<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovermentService extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'service_credential_id',
        'required_employment_status_id'
    ];

    public function ServiceCredential()
    {
        return $this->belongsTo('App\Models\ServiceCredential', 'service_credential_id','id');
    }

    public function EmploymentStatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus', 'required_employment_status_id','id');
    }
}
