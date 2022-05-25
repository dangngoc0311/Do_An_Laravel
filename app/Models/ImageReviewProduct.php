<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageReviewProduct extends Model
{
    use HasFactory;
    protected $fillable = ['image','review_product_id'];

}
