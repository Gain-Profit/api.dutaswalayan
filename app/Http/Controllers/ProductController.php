<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
// with eloquent
//        $products  = Product::all();
//
//        return response()->json($products);
        return app('db')->select('SELECT * FROM products');
    }

    public function replaceProducts(Request $request)
    {
// with eloquent
//        $products = Product::create($request->all());
//
//        return response()->json($products);

        $attr = ['pid' => $request->input('pid')];
        app('db')->table('products')->updateOrInsert($attr,$request->all());

// with facade
//        DB::table('products')->updateOrInsert($attr,$request->all());

        return response()->json($request->all());
    }

    public static function getLastTimeProduct()
    {
        $last = app('db')->select('SELECT updated FROM products ORDER BY updated DESC LIMIT 1');
        if ($last == []) {
            $last = [["updated" => "2001-01-01 00:00:00"]];
        }
        return $last;
    }

}
