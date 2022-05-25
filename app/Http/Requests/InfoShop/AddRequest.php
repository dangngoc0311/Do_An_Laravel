<?php

namespace App\Http\Requests\InfoShop;

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
            'email' => 'required|unique:info_shops',
            'phone' => 'required|max:11',
            'address' => 'required',
            'file' => 'mimes:jpeg,jpg,png,gif|required',
            'name' => 'required'
        ];
    }
    public function messages()
    {
        return [
            "email.required" => "Tên danh mục không được để trống",
            "email.unique" => "Tên danh mục $this->email đã tồn tại",
            "phone.required" => "Số điện thoại không được để trống",
            "phone.max" => "Vượt quá kí tự",
            "address.required" => "Địa chỉ không được để trống",
            "file.required" => "Ảnh logo không được để trống",
            "file.mimes" => "Không đúng định dạng ảnh",
            "name.required" =>"Tên shop không được để trống"
        ];
    }
}
