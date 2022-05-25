<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users', 'password' => 'required|min:6|confirmed'
        ];
    }
    public function messages()
    {
        return [
            "email.email" => "Email không đúng định dạng",
            "email.exists" => "Không có tài khoản",
            "email.required" => "Email không được để trống",
            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu phải lớn hơn 6 kí tự",
            "password.confirmed" => "Mật khẩu không đúng"
        ];
    }
}
