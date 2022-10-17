<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                Rule::unique('employee_roles')->where(fn ($query) => $query->where('role_id', request()->role_id)->where('department_id',request()->department_id)->where('school_level_id',request()->school_level_id)->where('employment_status_id',request()->employment_status_id)->where('start',request()->start)->where('end',request()->end))->ignore(request()->id)
            ],
            'role_id' => 'required',
            'department_id' => 'required',
            'school_level_id' => 'required',
            'employment_status_id' => 'required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
