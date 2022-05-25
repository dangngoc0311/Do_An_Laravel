<?php

namespace App\Http\Requests\Farmer;

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
            'email' => 'required|unique:farmers',
            'phone' => 'required|max:11|unique:farmers',
            'address' => 'required',
            'job' => 'required',
            'file' => 'mimes:jpeg,jpg,png,gif|required',
            'name' => 'required'
        ];
    }
    public function messages()
    {
        return [
            "email.required" => "Tên danh mục không được để trống",
            "email.unique" => "Tên danh mục $this->email đã tồn tại",
            "phone.unique" => "Số điện thoại $this->phone đã tồn tại",
            "phone.required" => "Số điện thoại không được để trống",
            "phone.max" => "Vượt quá kí tự",
            "address.required" => "Địa chỉ không được để trống",
            "file.required" => "Ảnh không được để trống",
            "file.mimes" => "Không đúng định dạng ảnh",
            "name.required" => "Tên không được để trống",
            "job.required" => "Công việc không được để trống"
        ];
    }
}
