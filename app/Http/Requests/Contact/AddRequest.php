<?php

namespace App\Http\Requests\Contact;

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
            'email' => 'required',
            'phone' => 'required|max:11',
            'name' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ];
    }
    public function messages()
    {
        return [
            "email.required" => "Tên danh mục không được để trống",
            "phone.required" => "Số điện thoại không được để trống",
            "phone.max" => "Vượt quá kí tự",
            "name.required" => "Tên không được để trống",
            "subject.required" => "Chủ đề không được để trống",
            "message.required" => "Nội dung không được để trống"
        ];
    }
}
