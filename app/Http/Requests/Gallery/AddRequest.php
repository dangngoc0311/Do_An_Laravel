<?php

namespace App\Http\Requests\Gallery;

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
            'file' => 'mimes:jpeg,jpg,png,gif|required',
            'category_gallery_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            "file.required" => "Ảnh  không được để trống",
            "file.mimes" => "Không đúng định dạng ảnh",
            "category_gallery_id.required" => "Danh mục không được để trống",

        ];
    }
}
