<?php

namespace App\Http\Requests\Coupon;

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
            'name' => 'required|unique:coupons,name,' . $this->id,
            'slug' => 'required|unique:coupons,slug,' . $this->id,
            'discount' => 'required|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:' . request()->start_date,
            'code' => 'required|min:6|unique:coupons,code,' . $this->id,
            'quantity' => 'required|min:1',
            'condition' => 'required'
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên mã giảm giá không được để trống",
            "name.unique" => "Tên mã giảm giá $this->name đã tồn tại",
            "slug.required" => "Đường dẫn URL không được để trống",
            "slug.unique" => "Đường dẫn URL $this->slug đã tồn tại",
            "discount.required" => "Số tiền, % giảm giá không được để trống",
            "discount.min" => "Số tiền,% giảm giá phải lớn hơn 1",
            "start_date.required" => "Ngày bắt đầu giảm giá không được để trống",
            "start_date.date" => "Không chọn đúng định dạng ngày",
            "end_date.required" => "Ngày kết thúc giảm giá không được để trống",
            "end_date.date" => "Không chọn đúng định dạng ngày",
            "end_date.after" => "Ngày giảm giá phải kết thúc sau ngày bắt đầu",
            "code.required" => "Mã giảm giá không được để trống",
            "code.min" => "Mã giảm giá phải lớn hơn 6 kí tự",
            "code.unique" => "Mã giảm giá $this->code đã tồn tại",
            "quantity.required" => "Số lượng mã giảm giá không được để trống",
            "quantity.min" => "Số lượng mã giảm giá phải lớn hơn 1",
            "condition.required" => "Điều kiện giảm giá không được để trống"
        ];
    }
}
