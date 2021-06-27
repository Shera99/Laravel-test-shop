<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            {{ $product->category->name }}
        </div>
        <br>
        <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg" alt="{{ $product->name }}">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} ₽</p>
            <p>
            <form action="{{ route('basket') }}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}"
                   class="btn btn-default"
                   role="button">Подробнее</a>
                <input type="hidden" name="_token" value="qC2icB2OibxxDS3HCMsBySUr1M5KIfDeQUeygdCH">
            </form>
            </p>
        </div>
    </div>
</div>
