@extends('welcome')
@section('content')
    <div class="container">
        <h2>Редактирование заказа № {{$order['order_id']}}</h2>
        <form  id="edit-order-form" action=" {{route('order-edit-store', ['id'=>$order['order_id']])}}" method="post"
               enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="client_email">Email</label>
                <input type="email" class="form-control" id="client-email" aria-describedby="emailHelp"
                       placeholder="Введите email" required value="{{$order['client_email']}}" name="clientEmail">
            </div>
            <div class="form-group">
                <label for="partner">Партнер</label>
                <select class="form-control" id="partner" required>
                    @foreach($partners as $partner)
                        <option value="{{$partner->id}}" {{($partner->id === $order['partner']) ? "selected" :
                       ''}}>{{$partner->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" id="status" required>
                    @foreach($statuses as $status_id=>$status)
                        <option value="{{$status_id}}" {{($status_id === $order['status']) ? 'selected' : ''}}>{{$status}}</option>
                    @endforeach
                </select>
            </div>
            <div class="products">
                <h4>Товары</h4>
                <div class="table_headers">
                    <div class="table_row flex-row">
                        <div class="header_item product_name">Товар</div>
                        <div class="header_item product_quantity">Количество</div>
                    </div>
                </div>
                <div class="table_body">
                    @foreach($order['order_list'] as $orderList)
                        <div class="order_item flex-row">
                            <div class="body_item product_name">{{$orderList['product_name']}}</div>
                            <div class="body_item product_quantity">
                                <input placeholder="Введите количество" required
                                       value="{{$orderList['product_quantity']}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
@endsection