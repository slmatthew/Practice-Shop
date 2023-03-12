@extends('app', ['navbar' => 'products'])

@section('content')
<div class="container">
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
                    @if($category)
                        <a href="{{ route('products.byCategory', $category->id) }}" class="badge bg-dark me-1" style="text-decoration: none">
                            {{ $category->name }}
                        </a>
                    @endif
                </div>

                <p class="lead">
                    @if($product->available)
                        <span>{{ number_format($product->price, 2, ',', ' ') }} ₽</span>
                    @else
                        <span class="me-1">
                            <del>{{ number_format($product->price, 2, ',', ' ') }} ₽</del>
                        </span>
                        <span>нет в наличии</span>
                    @endif
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
