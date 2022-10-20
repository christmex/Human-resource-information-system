<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'user_id' => [
                'nullable',
                'sometimes',
                Rule::unique('employees')->ignore(request()->id),
            ],
            'id_card' => [
                'nullable',
                'sometimes',
                Rule::unique('employees')->ignore(request()->id),
            ],
            'fullname' => [
                'required',
                Rule::unique('employees')->where(fn ($query) => $query->where('fullname',request()->fullname)->where('place_of_birth',request()->place_of_birth)->where('date_of_birth',request()->date_of_birth)->where('sex',request()->sex)->where('religion_id',request()->religion_id)->where('start_working',request()->start_working))->ignore(request()->id)
            ],
            // 'fullname' => 'required', //Kemungkinan pake ini untuk lebih dinamis, tpi dari 10 kasus hanya 1 kasus saja yang kemungkinan nama, ttl sama, jika itu yg diharapkan maka pakai ini yg di atas di comment
            'place_of_birth' => ['required'],
            'date_of_birth' => 'required',
            'sex' => 'required',
            'religion_id' => 'required',
            'start_working' => 'required',
            // for roles purpose
            'role_id' => 'required|sometimes',
            'employment_status_id' => 'required|sometimes',
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
