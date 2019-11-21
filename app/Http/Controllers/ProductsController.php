<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Отображение шаблона товаров
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $products = Product::orderBy('name', 'asc')->paginate(25);
        return view("products", ['products' => $products]);
    }

    /**
     * Редактирование цены товара
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $product = Product::find($request->json('product_id'));
        $product->price = $request->json('price');
        $product->save();
        return response()->json();
    }
}
