<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_no','order_number');
    }

    public static function countActiveOrder()
    {
        $data=Order::count();
        if($data)
        {
            return $data;
        }
        return 0;
    }

    public static function getAllOrder($id)
    {
        return Order::with('order_detail')->find($id);
    }
}
