<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

const STATUSES = [
    0 => "новый",
    10 => "подтвержден",
    20 => "завершен"
];

class OrdersController extends Controller
{
    private function getOrderCost($products)
    {
        $cost = null;
        foreach ($products as $product) {
            $cost += $product->quantity * $product->price;
        }
        return $cost;
    }

    private function getOrderList($orderProducts)
    {
        $products = [];
        foreach ($orderProducts as $orderProduct) {
            array_push($products, [
                'product_name' => $orderProduct->products->name,
                'product_quantity' => $orderProduct->quantity,
                'product_price' => $orderProduct->price,
            ]);
        }
        return $products;
    }

    private function getOrderStatus($statusId)
    {
        switch ($statusId) {
            case 0:
                $status = "новый";
                break;
            case 10:
                $status = "подтвержден";
                break;
            default:
                $status = "завершен";
                break;
        }
        return $status;
    }


    public function show()
    {
        $data = [];
        $orders = Order::all();
        foreach ($orders as $order) {
            array_push($data, [
                'order_id' => $order->id,
                'partner' => $order->partners->name,
                'order_cost' => $this->getOrderCost($order->orderProducts),
                'order_list' => $this->getOrderList($order->orderProducts),
                'status' => STATUSES[$order->status]
            ]);
        }
        return view("orders", ['orders' => $data]);
    }

    public function update($id)
    {
        $order = Order::where('id', '=', $id)->first();
        $data = [
            'order_id' => $id,
            'client_email' => $order->client_email,
            'status' => $order->status,
            'order_cost' => $this->getOrderCost($order->orderProducts),
            'order_list' => $this->getOrderList($order->orderProducts),
            'partner' => $order->partners->id,
        ];
        return view("order", ['order' => $data, 'partners' => Partner::get(['id', 'name']),'statuses' => STATUSES]);
    }

    public function store(Request $request)
    {
        $order = Order::find($request->id);
        dd($request->input('clientEmail'));
//        $flight = App\Flight::find(1);
//        $flight->name = 'New Flight Name';
//        $flight->save();
        return redirect()->back();
    }
}
