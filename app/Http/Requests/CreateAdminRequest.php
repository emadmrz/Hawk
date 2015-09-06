<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAdminRequest extends Request
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
            'first_name'=>'required|max:255|min:3',
            'last_name'=>'required|max:255|min:3',
            'email'=>'required|max:255|min:3|email|unique:users',
            'password'=>'required|max:255|min:6',
        ];
    }
}
