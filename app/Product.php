<?php
/**
 * Created by PhpStorm.
 * User: GUDANG01
 * Date: 11/04/2016
 * Time: 21:23
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['pid','barcode','description','unit','price','updated'];
}