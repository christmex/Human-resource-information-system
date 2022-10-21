<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCredential extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_url',
        'service_login',
        'service_password',
        'css_class',
        'description',
    ];

    public function ServiceUrl() {
        return '<a href="'.$this->service_url.'" target="_blank">'.$this->service_url.'</a>';
    }

    public function GovermentService(){
        return $this->hasOne(GovermentService::class);
    }
}
