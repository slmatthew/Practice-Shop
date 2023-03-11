<div class="col">
    <div class="card shadow-sm text-center">
        <img style="max-height:100%;max-width:100%;" src="{{ $product->image_url }}" />
        <div class="card-body caption">
            <h5>{{ $product->name }}</h5>
            <p class="card-text text-muted">
                @if(mb_strlen($product->description) > 160)
                    {{ mb_substr($product->description, 0, 160).'...' }}
                @else
                    {{ $product->description }}
                @endif
            </p>
            <p class="card-text">
                @if((bool)$product->available)
                    {{ number_format($product->price, 2, ',', ' ') }} ₽
                @else
                    Нет в наличии
                @endif
            </p>
            <div>
                <button type="button" class="btn btn-sm btn-primary" {{ (bool)$product->available ?: "disabled" }}>В корзину</button>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.item', $product->id) }}">Подробнее</a>
            </div>
        </div>
    </div>
</div>
