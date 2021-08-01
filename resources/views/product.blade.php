@extends('layouts.master')

@section('title', 'Продукт - ' . $product)

@section('content')
    <h1>iPhone X 64GB - {{ $product }}</h1>
    <h2>Мобильные телефоны</h2>
    <p>Цена: <b>71990 ₽</b></p>
    <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
    <p>Отличный продвинутый телефон с памятью на 64 gb</p>


    <span>product.not_available</span>
    <br>
    <span>Сообщить мне, когда товар появится в наличии:</span>
    <div class="warning">
    </div>
    <form method="POST" action="http://internet-shop.tmweb.ru/subscription/1">
        <input type="hidden" name="_token" value="TVtVOjV1tVsMnT0alZlxsBMs9kloBlfYhGtTqsQB"/>
        <input type="text" name="email"/>
        <button type="submit">Отправить</button>
    </form>
@endsection
