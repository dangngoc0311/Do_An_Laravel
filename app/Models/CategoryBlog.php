<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    use HasFactory;
    protected $fillable=['name','slug','status'];
    public function scopeSearch($query){
        if ($keyword = request()->keyword) {
            $query = $query->where('name','like','%'.$keyword.'%');
        }
        return $query;
    }
    public function getBlogs(){
        return $this->hasMany(Blog::class,'category_blogs_id','id');
    }
}
