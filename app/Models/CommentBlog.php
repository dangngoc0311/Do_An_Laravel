<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentBlog extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'user_id', 'blog_id', 'status'];
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getComments()
    {
        return $this->belongsTo(ReplyCommentBlog::class, 'id', 'comment_id');
    }
}
