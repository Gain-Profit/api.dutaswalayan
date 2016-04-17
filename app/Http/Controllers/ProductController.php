<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return app('db')->select('SELECT * FROM products');
    }

    public function getProductCompressed()
    {
        $dataDb = app('db')->select('SELECT * FROM products');
        $json = json_encode($dataDb);
        $gzdata = gzencode($json, 9);
        
        $fileName = "products.json.gz";
        $file = storage_path("download/" . $fileName);
        $fp = fopen($file, "w");
        fwrite($fp, $gzdata);
        fclose($fp);

        $headers = array();

        return response()->download($file, $fileName, $headers);
    }

    public function replaceProducts(Request $request)
    {
        $attr = ['pid' => $request->input('pid')];
        app('db')->table('products')->updateOrInsert($attr,$request->all());

        return response()->json($request->all());
    }

    public function getLastTimeProduct()
    {
        $last = app('db')->select('SELECT updated FROM products ORDER BY updated DESC LIMIT 1');
        if ($last == []) {
            $last = [["updated" => "2001-01-01 00:00:00"]];
        }
        return $last;
    }

    public function getProductByPid($pid)
    {
        $result = app('db')->select('SELECT * FROM products WHERE pid = "'. $pid . '"');

        return $result;
    }

    public function getProductByBarcode($barcode)
    {
        $result = app('db')->select('SELECT * FROM products WHERE barcode = "'. $barcode . '"');

        return $result;
    }


}
