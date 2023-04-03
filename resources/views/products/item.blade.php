@extends('app', ['navbar' => 'products'])

@section('content')
<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.categories') }}">Все категории</a></li>
            @if($category)
                <li class="breadcrumb-item"><a href="{{ route('products.byCategory', $category) }}">{{ $category->name }}</a></li>
            @endif
            @if($brand)
                <li class="breadcrumb-item"><a href="{{ route('products.byCategory', ['category' => $category, 'brand' => $brand]) }}">{{ $brand->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!--Grid column-->
        <div class="col-md-6">
            <img src="{{ $product->image_url }}" class="img-fluid img-thumbnail" alt="" />
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6">
            <!--Content-->
            <div class="p-4">
                <div class="mb-3">
                    @if($brand)
                        <a href="{{ route('products.brand', $brand) }}" class="badge bg-primary me-1" style="text-decoration: none">
                            {{ $brand->name }}
                        </a>
                    @endif

                    @if($category)
                        <a href="{{ route('products.byCategory', $category) }}" class="badge bg-dark me-1" style="text-decoration: none">
                            {{ $category->name }}
                        </a>
                    @endif

                    @php(date_default_timezone_set ('Europe/Moscow'))
                    @php($time_now = time())
                    @if($time_now - strtotime($product->created_at) - 10800 <= 86400)
                        <span class="badge bg-danger me-1">
                            Новинка!
                        </span>
                    @endif

                    @if($product->hasDiscountAndAvailable())
                        <span class="badge bg-danger me-1">
                            Скидка -{{ $product->getDiscountPercent() }}%
                        </span>
                    @endif
                </div>

                <p class="lead">
                    @if(!$product->available || $product->hasDiscountAndAvailable())
                        <span class="me-1">
                            <del>{{ $product->available ? $product->getFormattedPrice(true) : $product->getFormattedPrice() }}</del>
                        </span>
                    @endif
                    <span>{{ $product->available ? $product->getFormattedPrice() : 'нет в наличии' }}</span>
                </p>

                <strong><p style="font-size: 20px;">{{ $product->name }}</p></strong>

                <p>{{ $product->description }}</p>

                <form class="d-flex justify-content-left" action="{{ route('basket.addProduct') }}" method="post">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="product_id" value="{{ $product->id }}" />

                    <div class="form-outline me-1" style="width: 100px;">
                        <input type="number" name="quantity" value="1" class="form-control" {{ $product->available ? '' : 'disabled' }}/>
                    </div>
                    <button class="btn btn-primary ms-1" type="submit" {{ $product->available ? '' : 'disabled' }}>
                        В корзину
                    </button>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <a class="btn btn-outline-secondary ms-1" href="{{ route('admin.product', $product->id) }}" target="_blank" role="button">
                            Редактировать
                        </a>
                    @endif
                </form>
                @if ($errors->get('quantity'))
                    <div class="alert alert-danger mt-3" role="alert">
                        В корзину можно добавить от 1 до 10 товаров
                    </div>
                @elseif($errors->any())
                    <div class="alert alert-danger mt-3" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!--Content-->
        </div>
        <!--Grid column-->
    </div>
</div>
@endsection
