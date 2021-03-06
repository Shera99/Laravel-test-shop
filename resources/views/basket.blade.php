@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    @if (session()->has('add_basket'))
        <p class="alert alert-success">{{ session('add_basket') }}</p>
    @endif
    <h1>Корзина</h1>
    <p>Оформление заказа</p>
    <div class="panel">
        @if (isset($order))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Стоимость</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                                <img height="56px"
                                     src="http://internet-shop.tmweb.ru/storage/products/iphone_x_silver.jpg">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td><span class="badge">{{ $product->pivot->count }}</span>
                            <div class="btn-group form-inline">
                                <form action="{{ route('basket-remove', $product) }}" method="POST">
                                    <button type="submit" class="btn btn-danger" href=""><span
                                            class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                    @csrf
                                </form>
                                <form action="{{ route('basket-add', $product) }}" method="POST">
                                    <button type="submit" class="btn btn-success"
                                            href=""><span
                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                    @csrf
                                </form>
                            </div>
                        </td>
                        <td>{{ $product->price }} ₽</td>
                        <td>{{ $product->getPriceForCount($product->pivot->count) }} ₽</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Общая стоимость:</td>
                    <td>{{ $order->calculate() }} ₽</td>
                </tr>
                </tbody>
            </table>
        @else
            <center>Корзина пуста</center>
        @endif
        <br>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-success" href="{{ route('basket-place') }}">Оформить заказ</a>
        </div>
    </div>
@endsection
