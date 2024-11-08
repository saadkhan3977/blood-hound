<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded =[];

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
}
