@extends('welcome')
@section('content')
    <div class="container">
        <h2>Заказы</h2>
        <div class="row orders">
            @yield('orders_tabs')
            <div class="orders_table">
                <div class="table_headers">
                    <div class="table_row flex-row">
                        <div class="header_item order_id">№ заказа</div>
                        <div class="header_item partner">Партнер</div>
                        <div class="header_item order_cost">Стоимость</div>
                        <div class="header_item order_items">
                            <div>Состав</div>
                            <div class="flex-row">
                                <div class="header_item product_name">Товар</div>
                                <div class="header_item product_quantity">Количество</div>
                                <div class="header_item product_price">Цена</div>
                            </div>
                        </div>
                        <div class="header_item status">Статус</div>
                    </div>
                </div>
                <div class="table_body">
                    @foreach($orders as $order)
                        <div class="table_row flex-row">
                            <div class="body_item order_id">
                                <a href="{{route("order-edit", ['id'=>$order['order_id']])}}">{{$order['order_id']}}</a>
                            </div>
                            <div class="body_item partner">{{$order['partner']}}</div>
                            <div class="body_item order_cost">{{$order['order_cost']}}</div>
                            <div class="body_item order_items">
                                @foreach($order['order_list'] as $orderList)
                                    <div class="order_item flex-row">
                                        <div class="body_item product_name">{{$orderList['product_name']}}</div>
                                        <div class="body_item product_quantity">{{$orderList['product_quantity']}}</div>
                                        <div class="body_item product_price">{{$orderList['product_price']}}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="body_item status">{{$order['status']}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection