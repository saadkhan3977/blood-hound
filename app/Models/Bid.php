<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Bid extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function quote_info()
    {
        return $this->hasOne(Quote::class,'id','quote_id');
    }
    
    public function quote()
    {
        return $this->hasOne(Quote::class,'id','quote_id')->where('status','onGoing');
    }
    
    public function quote_infos()
    {
        return $this->hasOne(Quote::class,'id','quote_id')->where('user_id',Auth::user()->id);
    }
    
    public function user_info()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
