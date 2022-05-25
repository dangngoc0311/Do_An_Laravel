<?php

namespace App\Http\Requests\Farmer;

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:farmers,email,' . $this->id,
            'phone' => 'required|max:11|unique:farmers,phone,' . $this->id,
            'address' => 'required',
            'job' => 'required',
            'file' => 'mimes:jpeg,jpg,png,gif',
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
            "file.mimes" => "Không đúng định dạng ảnh",
            "name.required" => "Tên không được để trống",
            "job.required" => "Công việc không được để trống"
        ];
    }
}
