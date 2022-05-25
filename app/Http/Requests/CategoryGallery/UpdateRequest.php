<?php

namespace App\Http\Requests\CategoryGallery;

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
            'name' => 'required|unique:category_galleries,name,' . $this->id,
            'slug' => 'required|unique:category_galleries,slug,' . $this->id,
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên danh mục không được để trống",
            "name.unique" => "Tên danh mục $this->name đã tồn tại",
            "slug.required" => "Đường dẫn URL không được để trống",
            "slug.unique" => "Đường dẫn URL $this->slug đã tồn tại",
        ];
    }
}
