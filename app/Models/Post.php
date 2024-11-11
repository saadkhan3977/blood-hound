<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function my_like()
	{
		$profileId = Auth::id(); // Assuming you are using Laravel's request helper
	//    print_r($profileId);die;
	   return $this->hasOne(\App\Models\PostLike::class, 'post_id', 'id')->where('user_id', $profileId);
	}

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function locations()
    {
        return $this->hasMany(PostLocation::class);
    }

    public function tags()
    {
        return $this->hasMany(PostTag::class);
    }

    public function like()
    {
        return $this->hasMany(PostLike::class);
    }
    
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
