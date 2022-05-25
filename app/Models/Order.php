<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'address', 'note', 'total', 'delivery_id', 'coupon_id', 'free_ship_id', 'status', 'payment_id', 'status_payment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deliveries()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id', 'id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
    public function freeship()
    {
        return $this->belongsTo(FreeShip::class, 'free_ship_id', 'id');
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    public function getOrderTracking($user_id)
    {
        $order = Order::where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(1);
        return $order;
    }
    public function getTotalOrderByStatus($status)
    {
        $order = Order::where('status', $status)->count();
        return $order;
    }
}
