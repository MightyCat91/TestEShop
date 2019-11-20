@extends('welcome')
@section('content')
    <div class="container">
        <div class="orders_table">
            <div class="table_headers">
                <div class="table_row flex-row">
                    <div class="header_item">id товара</div>
                    <div class="header_item">Наименование</div>
                    <div class="header_item">Поставщик</div>
                    <div class="header_item status">Цена</div>
                </div>
            </div>
            <div class="table_body">
                @foreach ($products as $product)
                    <div id="products_table_body" class="table_row flex-row">
                        <div class="body_item product_id">{{$product['id']}}</div>
                        <div class="body_item">{{$product['name']}}</div>
                        <div class="body_item">{{$product->vendors->name}}</div>
                        <div class="body_item">
                            <input class="product_price" onchange="changePrice(this.value)"
                                   placeholder="Введите количество" required value="{{$product['price']}}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $products->links() }}
    </div>

@endsection('content')