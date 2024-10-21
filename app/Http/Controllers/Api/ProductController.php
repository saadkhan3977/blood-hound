<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        try{
            $data = Product::get();
            return response()->json(['success'=>true,'message'=>'Product Lists','product_list'=>$data]);
        }
        catch(\Eception $e)
        {
            return $this->sendError($e->getMessage());    
        }
    }
}
