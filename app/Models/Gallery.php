<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable=['image','category_gallery_id','status'];
    public function getCategoryGallery(){
        return $this->hasOne(CategoryGallery::class, 'id', 'category_gallery_id');
    }
    public function getGalleryByCategory($category_gallery_id)
    {
        // $category_gallery_id = Category::find($id);
        $gallery =  Gallery::where('status', '1')->where('category_gallery_id', $category_gallery_id)->orderBy('created_at', 'DESC')->limit(3)->get();
        return $gallery;
    }
}
