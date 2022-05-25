<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=['title','slug','cover_image','content','status','category_blogs_id'];
    public function getCategoryBlog(){
        return $this->hasOne(CategoryBlog::class, 'id', 'category_blogs_id');
    }
    public function getBlogByCategory($category_id)
    {
        $blog = Blog::where('category_blogs_id', $category_id)->where('status', 1)->paginate(6);
        return $blog;
    }
    public function scopeSearch($query){
        if ($keyword = request()->keyword) {
            $query = $query->where('title','like','%'.$keyword.'%');
        }
        return $query;
    }

}
