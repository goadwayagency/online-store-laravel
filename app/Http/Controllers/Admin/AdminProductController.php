<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Models\Product;

class AdminProductController extends Controller

{
    function index(){
       
        $products = Product::all();

        return view('admin.products.index', [ 'products' => $products]);
    }
}
