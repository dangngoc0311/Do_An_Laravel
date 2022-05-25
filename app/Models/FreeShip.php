<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeShip extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','status','discount','start_date','end_date','code','quantity'];
    public function scopeSearch($query){
        if ($keyword = request()->keyword) {
            $query = $query->where('name','like','%'.$keyword.'%');
        }
        return $query;
    }
}
