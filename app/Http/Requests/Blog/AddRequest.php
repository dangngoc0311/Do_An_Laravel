<?php

namespace App\Http\Requests\Blog;

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
            'title' => 'required|unique:blogs',
            'slug' => 'required|unique:blogs',
            'file' => 'mimes:jpeg,jpg,png,gif|required',
            'content'=>'required',
            'category_blogs_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            "title.required" => "Tiêu đề bài viết không được để trống",
            "title.unique" => "Tiêu đề bài viết $this->title đã tồn tại",
            "slug.required" => "Đường dẫn URL không được để trống",
            "slug.unique" => "Đường dẫn URL $this->slug đã tồn tại",
            "file.required" => "Ảnh bìa không được để trống",
            "file.mimes" => "Không đúng định dạng ảnh",
            "category_blogs_id.required" => "Danh mục  không được để trống",
"content.required" =>"Nội dung bài viết không được để trống"
        ];
    }
}
