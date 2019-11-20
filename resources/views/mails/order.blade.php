<p><u>Список товаров:</u></p>

@foreach ($product_list as $product)
    <div>
        <p><b>Товар:</b>&nbsp;{{ $product['product_name'] }}</p>
        <p><b>Количество:</b>&nbsp;{{ $product['product_quantity'] }}</p>
        <p><b>Цена:</b>&nbsp;{{ $product['product_price'] }}</p>
    </div>
    <hr/>
@endforeach

<div>
    <p><u><b>Итого:</b>&nbsp;{{ $cost }}</u></p>
</div>

Спасибо.