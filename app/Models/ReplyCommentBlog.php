<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyCommentBlog extends Model
{
    use HasFactory;
    protected $fillable = ['comment','user_id','comment_id','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
