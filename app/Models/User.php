<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'role',
        'remember_token',
		'email_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function quotes() {
        return $this->hasMany(Quote::class,'user_id','id');
    }

    public function total_document()
    {
        return $this->hasMany(Document::class,'user_id','id');
    }

    public function document_pdf()
    {
        return $this->hasMany(Document::class,'user_id','id')->where('type','pdf');
    }
    
    public function document_url()
    {
        return $this->hasMany(Document::class,'user_id','id')->where('type','url');
    }
    public function document_text()
    {
        return $this->hasMany(Document::class,'user_id','id')->where('type','text');
    }
    public function document_image()
    {
        return $this->hasMany(Document::class,'user_id','id')->where('type','image');
    }
    
    public function negotiator_review() {
        return $this->hasMany(Review::class,'assign_user_id','id');
    }
   
    // public function negotiator_quotes() 
    // {
    //     return $this->hasMany(Quote::class, 'negotiator_id');
    // }

    // public function total_earning() 
    // {
    //     return $this->quotes()->where(['status' => 'completed'])->get();
    // }
    public function total_earning() 
    {
        return $this->hasMany(Quote::class, 'negotiator_id')->where(['negotiator_id'=>Auth::user()->id ,'status'=>'completed']);
    }
    
    public function sum_negotiator() 
    {
        return $this->total_earning();
    }

    public function current_month_total_earning() 
    {
        $now = Carbon::now();
        return $this->hasMany(Quote::class, 'negotiator_id')->where(['negotiator_id'=>Auth::user()->id ,'status'=>'completed'])->whereMonth('created_at', $now->month);
    }
    
    public function current_month_earning() 
    {
        return $this->current_month_total_earning();
    }

    
    public function ratings()
    {
        return $this->hasMany(Review::class, 'assign_user_id');
    }
    

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
    
}
