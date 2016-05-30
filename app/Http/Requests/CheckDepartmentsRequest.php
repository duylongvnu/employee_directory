<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckDepartmentsRequest extends Request
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
            //thiết lập các rule cho form
            'name' => 'required|min:6', //field name bắt buộc nhập và phải có tối thiểu 6 ký tự
            'office_phone' => 'required', //field office_phone bắt buộc nhập
        ];
    }
}
