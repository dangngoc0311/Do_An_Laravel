<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity', 'status'];
    public function productInOrderDetail()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
