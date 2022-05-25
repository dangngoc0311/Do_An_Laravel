<?php

namespace App\Http\Requests\Ship;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            "price" => "required",
            "xa_id" => "required|unique:deliveries",
            "tp_id" => "required", "qh_id" => "required"
        ];
    }
    public function messages()
    {
        return [
            "price.required" => "Giá ship không được để trống",
            "xa_id.required" => "Không được để trống",
            "qh_id.required" => "Không được để trống",
            "tp_id.required" => "Không được để trống",
            "xa_id.unique" => "Điạ chỉ đã tồn tại"
        ];
    }
}
