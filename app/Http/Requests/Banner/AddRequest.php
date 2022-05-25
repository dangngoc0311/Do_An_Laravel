<?php

namespace App\Http\Requests\Banner;

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
            'slogan' => 'required', 'slug' => 'required',
            'file' => 'mimes:jpeg,jpg,png,gif|required',

        ];
    }
    public function messages()
    {
        return [
            "slogan.required" => "Tiêu đề không được để trống",
            "slug.required" => "Đường dẫn URL không được để trống",
            "file.required" => "Ảnh logo không được để trống",
            "file.mimes" => "Không đúng định dạng ảnh",

        ];
    }
}
