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

/**
 * Route to get all product on json format.
 */
$app->get('products','ProductController@index');

/**
 * Route to get all product on compressed json with Gzip
 */
$app->get('products/jsonGzip','ProductController@getProductCompressed');

/**
 * Route to get product by pid
 */
$app->get('products/pid/{pid}','ProductController@getProductByPid');

/**
 * Route to get product by barcode
 */
$app->get('products/barcode/{barcode}','ProductController@getProductByBarcode');

/**
 * Route to get last time product updated.
 */
$app->get('productsLastUpdate','ProductController@getLastTimeProduct');
