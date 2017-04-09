<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
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
            'cellphone' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cellphone.required' => '手机号码必须填写',
            'password.required'  => '密码必须填写',
        ];
    }
}
