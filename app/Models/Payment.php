<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['name','status','slug'];
    public function scopeSearch($query){
        if ($keyword = request()->keyword) {
            $query = $query->where('name','like','%'.$keyword.'%');
        }
        return $query;
    }
}
