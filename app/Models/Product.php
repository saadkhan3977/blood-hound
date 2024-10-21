<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use Auth;

class Product extends Model
{
    protected $guarded=[];

    public function cat_info()
    {
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    
    public function sub_cat_info()
    {
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    
    public static function getAllProduct()
    {
        return Product::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }
    
    public function rel_prods()
    {
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    
    public function getReview()
    {
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    
    public function sizes()
    {
        // return $this->hasMany(VeriantSize::class,'product_id','id');
        return $this->hasMany('App\Models\VeriantSize','product_id','id');
    }
    public function colors()
    {
        // return $this->hasMany(VeriantSize::class,'product_id','id');
        return $this->hasMany('App\Models\VeriantColor','product_id','id');
    }
    
    public static function getProductBySlug($slug)
    {
        return Product::with(['cat_info','rel_prods','getReview','sizes','colors'])->where('slug',$slug)->first();
    }
    
    public static function countActiveProduct()
    {
        if(auth::user()->role =='admin')
        {
            $data=Product::where('status','active')->count();
            if($data)
            {
                return $data;
            }
        }
        else
        {
            $data = Product::where(['status'=>'active','user_id'=> Auth::user()->id])->count();
            if($data)
            {
                return $data;
            }
        }
        return 0;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    
    

}
