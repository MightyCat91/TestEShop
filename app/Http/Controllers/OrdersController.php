<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Order;
use App\Partner;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                'product_id' => $orderProduct->id,
                'product_name' => $orderProduct->products->name,
                'product_quantity' => $orderProduct->quantity,
                'product_price' => $orderProduct->price,
            ]);
        }
        return $products;
    }

    private function sendEmail($order_id)
    {
        $vendor_emails = [];
        $order = Order::where('id', '=', $order_id)->first();
        $cost = $this->getOrderCost($order->orderProducts);
        $productList = $this->getOrderList($order->orderProducts);
        foreach ($order->orderProducts as $products) {
            array_push($vendor_emails, $products->products->vendors->email);
        }
        Mail::to($order->partners->email)->cc(array_unique($vendor_emails))->send(new OrderEmail($productList, $cost));
    }

    private function generationDataForView($orders)
    {
        $data = [];
        foreach ($orders as $order) {
            array_push($data, [
                'order_id' => $order->id,
                'partner' => $order->partners->name,
                'order_cost' => $this->getOrderCost($order->orderProducts),
                'order_list' => $this->getOrderList($order->orderProducts),
                'status' => STATUSES[$order->status]
            ]);
        }
        return $data;
    }

    private function getDateTimeForQuery($interval = null, $direction = 'plus')
    {
        $date = new DateTime("now", new DateTimeZone('Europe/Moscow'));
        if (!empty($interval)) {
            if ($direction == 'plus') {
                $date->add(new DateInterval($interval));
            } elseif ($direction == 'minus') {
                $date->sub(new DateInterval($interval));
            }
        }
        $date->format('Y-m-d H:i:s');
        return $date;
    }

    public function showCurrentOrders()
    {
        $orders = Order::where([
            ['delivery_dt', '<', $this->getDateTimeForQuery('P1D')],
            ['delivery_dt', '>', $this->getDateTimeForQuery()],
            ['status', '=', 10],
        ])->orderBy('delivery_dt', 'asc')->get();
        return view("current_orders", ['orders' => $this->generationDataForView($orders)]);
    }

    public function showNewOrders()
    {
        $orders = Order::where([
            ['delivery_dt', '>', $this->getDateTimeForQuery()],
            ['status', '=', 0],
        ])->limit(50)->orderBy('delivery_dt', 'asc')->get();
        return view("new_orders", ['orders' => $this->generationDataForView($orders)]);
    }

    public function showOldOrders()
    {
        $orders = Order::where([
            ['delivery_dt', '<', $this->getDateTimeForQuery()],
            ['status', '=', 10],
        ])->limit(50)->orderBy('delivery_dt', 'desc')->get();
        return view("old_orders", ['orders' => $this->generationDataForView($orders)]);
    }

    public function showCompletedOrders()
    {
        $orders = Order::where([
            ['delivery_dt', '>', $this->getDateTimeForQuery('P1D', 'minus')],
            ['delivery_dt', '<', $this->getDateTimeForQuery()],
            ['status', '=', 20],
        ])->limit(50)->orderBy('delivery_dt', 'desc')->get();
        return view("completed_orders", ['orders' => $this->generationDataForView($orders)]);
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
        return view("order", ['order' => $data, 'partners' => Partner::get(['id', 'name']), 'statuses' => STATUSES]);
    }

    public function store(Request $request)
    {
        $order = Order::find($request->id);
        $order->client_email = $request->clientEmail;
        $order->status = $request->status;
        $order->partner_id = $request->partner;
        foreach ($request->productQuantity as $product_id => $quantity) {
            $order->orderProducts->where('id', '=', $product_id)->first()->quantity = $quantity;
        }
        $order->push();
        if ($request->status == 20) {
            $this->sendEmail($request->id);
        }
        return redirect()->back();
    }
}
