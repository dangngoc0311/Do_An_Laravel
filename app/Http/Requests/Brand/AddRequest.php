<?php

namespace App\Http\Requests\Brand;

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
            'name' => 'required|unique:brands', 'slug' => 'required|unique:brands',
            'file' => 'mimes:jpeg,jpg,png,gif|required', 'email' => 'required|unique:brands',
            'phone' => 'required|unique:brands|max:11',
            'address' => 'required', 'about' => 'required'
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên không được để trống",
            "name.unique" => "Tên $this->name đã tồn tại",
            "slug.required" => "Đường dẫn URL không được để trống",
            "slug.unique" => "Đường dẫn URL $this->slug đã tồn tại",
            "file.required" => "Ảnh logo không được để trống",
            "file.mimes" => "Không đúng định dạng ảnh",
            "email.required" => "Email không được để trống",
            "email.unique" => "Email $this->email đã tồn tại",
            "phone.required" => "Số điện thoại không được để trống",
            "phone.unique" => "Số điện thoại $this->phone đã tồn tại",
            "about.required" =>"Mô tả không được để trống",
            "phone.max" => "Vượt quá kí tự",
            "address.required" => "Địa chỉ không được để trống",
        ];
    }
}
