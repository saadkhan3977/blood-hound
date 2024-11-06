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
        return $this->belongsToMany(PostLocation::class);
    }

    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_tags');
    }
}
