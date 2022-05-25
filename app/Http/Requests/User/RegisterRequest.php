<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users', 'password' => 'required|min:6',
            'password2' => 'required|same:password'
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên không được để trống",
            "email.required" => "Email không được để trống",
            "email.unique" => "Email đã tồn tại",
            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu phải lớn hơn 6 kí tự",
            "password2.required" => "Xác nhận mật khẩu không được để trống",
            "password2.same" => "Không trùng khớp với mật khẩu"
        ];
    }
}
