<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function scopeSearch($query)
    {
        if ($keyword = request()->keyword) {
            $query = $query->where('slogan', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
    use HasFactory;
    protected $fillable = ['slogan', 'image', 'status', 'slug'];
}
