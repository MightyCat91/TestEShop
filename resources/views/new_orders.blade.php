@extends('orders')
@section('orders_tabs')
    <ul class="nav nav-tabs">
        <li role="tab"><a href="{{route('current_orders')}}">Текущие</a></li>
        <li role="tab" class="active"><a href="{{route('new_orders')}}">Новые</a></li>
        <li role="tab"><a href="{{route('old_orders')}}">Просроченные</a></li>
        <li role="tab"><a href="{{route('completed_orders')}}">Выполненные</a></li>
    </ul>
@endsection