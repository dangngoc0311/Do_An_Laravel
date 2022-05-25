<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'image', 'price', 'sale_price', 'status', 'isHot', 'category_id', 'brand_id', 'description', 'import_quantity'];
    public function scopeSearch($query)
    {
        $keyword  = request()->keyword;
        $brand = request()->nhan_hang;
        $category = request()->danh_muc;
        if ($keyword && $category && $brand) {
            $query = $query->where('name', 'like', '%' . $keyword . '%')->where('category_id', $category)->where('brand_id', $brand);
        } elseif ($keyword && $category) {
            $query = $query->where('name', 'like', '%' . $keyword . '%')->where('category_id', $category);
        } elseif ($keyword && $brand) {
            $query = $query->where('name', 'like', '%' . $keyword . '%')->where('brand_id', $brand);
        } elseif ($category && $brand) {
            $query = $query->where('category_id', $category)->where('brand_id', $brand);
        } elseif ($category) {
            $query = $query->where('category_id', $category);
        } elseif ($brand) {
            $query = $query->where('brand_id', $brand);
        } else {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function getBrand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
    public function getImageProduct()
    {
        return $this->hasMany(ImageProduct::class);
    }
    public function getProductByCategory($category_id)
    {
        $product = Product::where('category_id', $category_id)->paginate(6);
        return $product;
    }
    public function getProductByBrand($brand_id)
    {
        $product = Product::where('brand_id', $brand_id)->paginate(6);
        return $product;
    }

    public function getHotProducts($cate_product_id)
    {
        // $cate_product_id = Category::find($id);
        $hot_product =  Product::where('status', '1')->where('isHot', 1)->where('category_id', $cate_product_id)->orderBy('created_at', 'DESC')->limit(3)->get();
        return $hot_product;
    }
    public function getInventoryById($id)
    {
        $inventory = OrderDetail::select(DB::raw('SUM(order_details.quantity) as qty'))->groupBy('order_details.product_id')->where('order_details.product_id', $id)->first();
        return $inventory;
    }
}
