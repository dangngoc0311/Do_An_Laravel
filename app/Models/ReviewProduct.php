<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReviewProduct extends Model
{
    use HasFactory;
    protected $fillable = ['rating', 'message', 'order_detail_id'];
    public function getOrder($product_id)
    {
        $reviewer = DB::table('review_products')->join('order_details', 'order_details.id', '=', 'review_products.order_detail_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('products.id', $product_id)
            ->select('review_products.*', 'users.name AS user_name','users.image AS user_image')
            ->get();
        return $reviewer;
    }
    public function getImageByReview($id)
    {
        $data = ReviewProduct::find($id);
        return $data;
    }
    public function getImageReview()
    {
        return $this->hasMany(ImageReviewProduct::class);
    }


}
