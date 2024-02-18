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

    public function getBuyAjaxPage()
    {
        $products = Product::take(3)->get();
        /*
        $products = Product::with('pictures')->get();
        $order = Order::with('product')->get();
        error_log($order);
        foreach ($order as $i) {
            error_log("hello " . $order);
        }

      error_log("h");
 */
        return view('buyAjax', ['data' => $products]);

    }
/*
    public function returnAjax()
    {
        try {
            $products = Product::all();
            Log::info('Products: ', ['products' => $products]); // new logging statement

            return response()->json(['products' => $products]);
        } catch (\Exception $e) {
            Log::error('Error fetching products: ', ['error' => $e->getMessage()]); // new logging statement
        }
    }
*/
    public function limitShowing(Request $request)
    {
        $offset = $request->input('offset', 0);
        $products = Product::skip($offset)->take(3)->get();

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

            return response()->json(['html' => $view, 'SENDSTUFF'=>$products, "Info got sent from limit show"]);
        }
        return view('buyAjax',['SENDSTUFF'=>$products]);
        //return view('buyAjax', compact('products'));
    }

    /*    public function search(Request $request)
        {
            $query = $request->input('query');
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();

            return view('search', compact('products'));
        }
    */
    /*

        public function search(Request $request)
        {
            $query = $request->input('query');
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();

            // Returning the HTML content
            $response = '';
            foreach ($products as $product) {
                $response .= view('components.product-card-ajax', compact('product'))->render();
            }

        }
    }

    */

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('name','like','%'.$search.'%')->paginate(5);

        $view = view('components.product-card', compact('products'))->render();

        $pagination = $products->links('pagination.custom')->render();

        return response()->json(['view' => $view, 'pagination' => $pagination]);


        /*
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        $response = '';
        foreach ($products as $product) {
            $response .= view('components.product-card', [
                'productTitle' => ucfirst(str_replace('_', ' ', $product->name)),
                'src' => asset('images/' . $product->pictures->fileName . $product->pictures->fileExtension),
                'productInput' => $product->name . '-input',
                'productDescription' => $product->description,
                'product' => $product
            ])->render();
        }
        */
    }
}

