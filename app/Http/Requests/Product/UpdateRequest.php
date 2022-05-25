<?php

namespace App\Http\Requests\Product;

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
            'name' => 'required|unique:products,name,' . $this->id,
            'slug' => 'required|unique:products,slug,' . $this->id,
            'file' => 'mimes:jpeg,jpg,png,gif',
            'files' => 'mimes:jpeg,jpg,png,gif',
            'price' => 'required|integer|min:1',
            'sale_price' => 'integer|max:'.request()->price,
            'category_id' => 'required',
            'brand_id' => 'required',
            'import_quantity' => 'required|integer|min:1'
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên danh mục không được để trống",
            "name.unique" => "Tên danh mục $this->name đã tồn tại",
            "slug.required" => "Đường dẫn URL không được để trống",
            "slug.unique" => "Đường dẫn URL $this->slug đã tồn tại",
            "file.mimes" => "Không đúng định dạng ảnh",
            "files.mimes" => "Không đúng định dạng ảnh",
            "price.required" => "Gía sản phẩm không được để trống",
            "price.integer" => "Gía sản phẩm phải là số",
            "price.min" => "Gía sản phẩm phải lớn hơn một",
            "sale_price.max" => "Gía sale không được lớn hơn giá",
            "sale_price.integer" => "Gía sale sản phẩm phải là số",
            "category_id.required" => "Danh mục sản phẩm không được để trống",
            "brand_id.required" => "Nhãn hàng sản phẩm không được để trống",
            "import_quantity.required" => "Số lượng sản phẩm không được để trống",
            "import_quantity.integer" => "Số lượng sản phẩm phải là số",
            "import_quantity.min" => "Số lượng sản phẩm phải lớn hơn 1"
        ];
    }
}
