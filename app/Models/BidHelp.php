<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidHelp extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function images()
    {
        return $this->hasMany(BidHelpImage::class,'bid_help_id','id');
    }

    public function user_info()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
   
    public function negotiator_info()
    {
        return $this->hasOne(User::class,'id','negotiator_id');
    }

}
