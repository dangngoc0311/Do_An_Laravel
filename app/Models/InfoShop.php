<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoShop extends Model
{
    use HasFactory;
    protected $fillable = [
        'email', 'phone', 'address', 'status', 'logo','name'
    ];
    public function scopeSearch($query){
        if ($keyword = request()->keyword) {
            $query = $query->where('name','like','%'.$keyword.'%');
        }
        return $query;
    }
}
