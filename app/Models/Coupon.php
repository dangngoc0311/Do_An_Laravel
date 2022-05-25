<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status', 'discount', 'start_date', 'end_date', 'code', 'quantity', 'condition'];
    public function scopeSearch($query)
    {
        if ($keyword = request()->keyword) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }

}
