<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'        => 'required|email|unique:users',
            'password'     => 'required',
            'password_confirmation' => 'required|same:password',
            'name'         => 'required',
            'phone'        => 'required',
            'company_name' => 'required',
            'company_position' => 'required',
            'company_inn'  => 'required|numeric'
        ];
    }
}
