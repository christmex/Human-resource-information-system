<?php

namespace App\Models;

use App\Models\ServiceCredential;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'read_employee_rules',
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
        return $this->belongsTo('App\Models\Religion', 'religion_id','id');
    }

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

    public function AllRoles()
    {
        return $this->JustRoles()->with('Role');
    }

    public function EmployeeRegisterAtGovService(){
        return $this->JustEmployeeRegisterAtGovService()->with('ServiceCredential');
    }

    public function JustEmployeeWithEmploymentStatus(){
        return $this->JustRoles()->with('EmploymentStatus');
    }

    public function JustRoles(){
        return $this->hasMany('App\Models\EmployeeRole');
    }

    public function JustEmployeeRegisterAtGovService(){
        return $this->hasMany('App\Models\EmployeeRegisterAtGovService');
    }

    public function GetMinEmployeeEmploymentStatus(){
        // Get all employee status from employee roles
        $employeeStatus = []; // All employee Status
        foreach ($this->JustEmployeeWithEmploymentStatus as $value) {
            // $employeeStatus[] = $value->employment_status_id;
            $employeeStatus[] = $value->EmploymentStatus->order;
        }
        return min($employeeStatus); // Get the highest employee status
    } 

    public function ButtonForRegisterEmployeeToGovService($crud = false)
    {
        $result = "";

        // Gett all Service redential
        $data = ServiceCredential::with('GovermentService.EmploymentStatus')->get();

        //
        $employeeStatusMin = $this->GetMinEmployeeEmploymentStatus(); // Get the highest employee status

        // Get All Employee who already registered at gov service
        $employeeRegisteredatGovService = [];
        foreach ($this->JustEmployeeRegisterAtGovService as $value) {
            $employeeRegisteredatGovService[] = $value->service_credential_id;
        }

        foreach ($data as $value) {
            

            // Cek jika employee sudah ada data di Employee Register at Gov Service maka tidka usah tampilkan lagi tombolnya
            if(!in_array($value->id,$employeeRegisteredatGovService)){
                // Cek jika employee status di atas semua service
                if($value->GovermentService->EmploymentStatus->order >= $employeeStatusMin){
                    $result .= '<a class="btn btn-sm btn-link" target="_blank" href="'.$value->service_url.'" data-toggle="tooltip" title="Add to '.$value->service_name.'."><i class="la la-plus"></i> Add to '.$value->service_name.'.</a>';
                }
            }

            
        }
        return $result;

    }

}
