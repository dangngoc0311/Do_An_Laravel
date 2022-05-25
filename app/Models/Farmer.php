<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $fillable = ['name','phone','email','address','job','image'];
    public function scopeSearch($query){
        if ($keyword = request()->keyword) {
            $query = $query->where('name','like','%'.$keyword.'%');
        }
        return $query;
    }
}
