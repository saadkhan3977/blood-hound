<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    use HasFactory;
    protected $guarded =[];

    // Relationship to parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relationship to replies
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class, 'comment_id');
    }

    public function my_like()
	{
		$profileId = Auth::id(); // Assuming you are using Laravel's request helper
	//    print_r($profileId);die;
	   return $this->hasOne(\App\Models\CommentLike::class)->where('user_id', $profileId);
	}

    // Check if a specific user has liked the comment
    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
