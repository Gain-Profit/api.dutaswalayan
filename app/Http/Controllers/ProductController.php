<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * get all product on json format
     *
     * @return mixed
     */
    public function index()
    {
        return app('db')->select('SELECT * FROM products');
    }

    /**
     * Download compressed product on Gzip.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getProductCompressed()
    {
        $dataDb = app('db')->select('SELECT * FROM products');
        $json = json_encode($dataDb);
        $gzData = gzencode($json, 9);
        
        $fileName = "products.json.gz";
        $file = storage_path("download/" . $fileName);
        $fp = fopen($file, "w");
        fwrite($fp, $gzData);
        fclose($fp);

        $headers = array();

        return response()->download($file, $fileName, $headers);
    }

    /**
     * Replace product with request.
     *
     * @param Request $request product data to be replaced.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function replaceProducts(Request $request)
    {
        $attr = ['pid' => $request->input('pid')];
        app('db')->table('products')->updateOrInsert($attr,$request->all());

        return response()->json($request->all());
    }

    /**
     * get last time updated product.
     *
     * @return mixed last time product updated
     */
    public function getLastTimeProduct()
    {
        $last = app('db')->select('SELECT updated FROM products ORDER BY updated DESC LIMIT 1');
        if ($last == []) {
            $last = [["updated" => "2001-01-01 00:00:00"]];
        }
        return $last;
    }

    /**
     * get json product by products id.
     *
     * @param $pid product id
     * @return mixed
     */
    public function getProductByPid($pid)
    {
        $result = app('db')->select('SELECT * FROM products WHERE pid = "'. $pid . '"');

        return $result;
    }

    /**
     * get json product by barcode.
     *
     * @param $barcode product
     * @return mixed
     */
    public function getProductByBarcode($barcode)
    {
        $result = app('db')->select('SELECT * FROM products WHERE barcode = "'. $barcode . '"');

        return $result;
    }


}
