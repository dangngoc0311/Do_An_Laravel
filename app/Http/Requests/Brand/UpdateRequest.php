<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' =>  'required', 'unique:brands,name,' . $this->id,
            'slug' => 'required|unique:brands,slug,' . $this->id,
            'file' => 'mimes:jpeg,jpg,png,gif',
            'email' => 'required|unique:brands,email,'. $this->id,
            'phone' => 'required|max:11|unique:brands,phone,'. $this->id,
            'address' => 'required', 'about' => 'required'
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên c không được để trống",
            "name.unique" => "Tên c $this->name đã tồn tại",
            "slug.required" => "Đường dẫn URL không được để trống",
            "slug.unique" => "Đường dẫn URL $this->slug đã tồn tại",
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
