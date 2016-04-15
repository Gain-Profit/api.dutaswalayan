<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return 'RERTful api for DUTA SWALAYAN';
});

//$app->get('/products', function () {
//    return app('db')->select("SELECT * FROM products");
//});

$app->get('products','ProductController@index');
$app->post('products','ProductController@replaceProducts');
$app->get('products/{pid}','ProductController@getProductByPid');
$app->get('products/{barcode}','ProductController@getProductByBarcode');
$app->get('productsLastUpdate','ProductController@getLastTimeProduct');
