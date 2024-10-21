<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function quote_info()
    {
        return $this->hasOne(Quote::class,'id','quote_id');
    }
    
    public function user_info()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratedUser()
    {
        return $this->belongsTo(User::class, 'assign_user_id');
    }
}
