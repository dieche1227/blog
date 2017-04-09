<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressPost extends FormRequest
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
            //
            'consignee'=>'required|min:2|max:8',
            'address'=>'required|min:2',
            // 'region[0]'=>'required',
            // 'region[1]'=>'required',
            'mobile'=>'required'
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'consignee.required' => '收货人必须填写',
            'consignee.min' => '收货人姓名不能小于2个长度',
            'consignee.max' => '收货人姓名不能多于8个长度',
            'address.required'  => '地址必须填写',
            // 'region[0].required' => '请选择省',
            // 'region[1].required' => '请选择市',
            'mobile.required' => '请填写号码'
        ];
    }
}
