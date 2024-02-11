<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function getBuyAjaxPage(){
        $products = Product::with('pictures')->get();
        $order = Order::with('product')->get();
        error_log($order);
        foreach ($order as $i){
            error_log("hello ". $order);
        }

//        error_log("h");
        return view('buyAjax',['data'=>$products]);

    }

    public function returnAjax()
    {
        try {
            $products = Product::all();
            Log::info('Products: ', ['products' => $products]); // new logging statement

            return response()->json(['products'=>$products]);
        } catch(\Exception $e) {
            Log::error('Error fetching products: ', ['error' => $e->getMessage()]); // new logging statement
        }
    }
}

