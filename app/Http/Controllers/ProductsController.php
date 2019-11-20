<?php

namespace App\Http\Controllers;

use App\Product;

class ProductsController extends Controller
{
    public function show()
    {
        $products = Product::orderBy('name', 'asc')->paginate(25);
        return view("products", ['products' => $products]);
    }
}
