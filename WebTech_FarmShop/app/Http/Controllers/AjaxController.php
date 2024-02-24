<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
/*
    public function getBuyAjaxPage()
    {
        $products = Product::take(3)->get();

        return view('buyAjax', ['data' => $products]);

    }
*/
    /*
     * Function for getting data from database, only sends 3 at beginning
     * to not load everything, whole lotta duplicate data because only like
     * 6 products
     * Also loads all the data into the product-card, i have no idea if this
     * is bad practise or not, but it made the rendering work so eh?
     *
     * Only sends ajax data if the button is clicked, otherwise works as normal
     * request view method
     * */
    public function limitShowing(Request $request)
    {
        $offset = $request->input('offset', 0);
        $products = Product::skip($offset)->take(3)->get();
        $totalProducts = Product::count();

        if($request->ajax()){
            $view = '';

            foreach ($products as $product) {
                $view .= view('components.product-card', [
                    'productTitle' => ucfirst(str_replace('_', ' ', $product->name)),
                    'src' => asset('images/' . $product->pictures->fileName . $product->pictures->fileExtension),
                    'productInput' => $product->name . '-input',
                    'productDescription' => $product->description,
                    'product' => $product
                ])->render();
            }

            return response()->json(['html' => $view, 'SENDSTUFF'=>$products, "Info got sent from limit show", 'total' => $totalProducts]);
        }
        return view('buyAjax',['SENDSTUFF'=>$products]);
        //return view('buyAjax', compact('products'));
    }



    public function search(Request $request)
    {
        $userInput = $request->query('query', '');

        if ($userInput === '') {
            return response()->json(['html' => '']);
        }

        $products = Product::where('name', 'like', '%' . $userInput . '%')->get();

        if (count($products) === 0) {
            return response()->json(['html' => '<p>No products found.</p>']);
        }

        $view = '';

        foreach ($products as $product) {
            $view .= view('components.product-card', [
                'productTitle' => ucfirst(str_replace('_', ' ', $product->name)),
                'src' => asset('images/' . $product->pictures->fileName . $product->pictures->fileExtension),
                'productInput' => $product->name . '-input',
                'productDescription' => $product->description,
                'product' => $product
            ])->render();
        }
        return response()->json(['html'=>$view]);
    }
}

