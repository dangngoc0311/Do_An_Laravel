<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryGallery extends Model
{
    use HasFactory;
    protected $fillable=['name','slug','status'];
    public function getGallery(){
        return $this->hasMany(Gallery::class,'category_gallery_id','id');
    }
    public function scopeSearch($query){
        if ($keyword = request()->keyword) {
            $query = $query->where('name','like','%'.$keyword.'%');
        }
        return $query;
    }
}
