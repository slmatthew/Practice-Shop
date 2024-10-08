<div class="col">
    <div class="card shadow-sm text-center">
        <img style="max-height:100%;max-width:100%;" src="{{ $product->image_url }}" />
        <div class="card-body caption">
            <h5>
                {{ $product->name }}
            </h5>
            <p class="card-text text-muted">
                @if(mb_strlen($product->description) > 160)
                    {{ mb_substr($product->description, 0, 160).'...' }}
                @else
                    {{ $product->description }}
                @endif
            </p>
            <p class="card-text">
                {{ $product->available ? $product->getFormattedPrice() : 'Нет в наличии' }}
                @if($product->hasDiscountAndAvailable())
                    <span class="badge rounded-pill bg-danger me-1">
                        -{{ $product->getDiscountPercent() }}%
                    </span>
                @endif
            </p>
            <div>
                <form action="{{ route('basket.addProduct') }}" method="post">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="hidden" name="quantity" value="1" />

                    <button type="submit" class="btn btn-sm btn-primary" {{ (bool)$product->available ?: "disabled" }}>В корзину</button>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.item', $product) }}">Подробнее</a>
                </form>
            </div>
        </div>
    </div>
</div>
