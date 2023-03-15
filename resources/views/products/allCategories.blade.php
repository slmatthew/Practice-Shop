@extends('app', ['navbar' => 'products', 'css' => ['allctgs.css']])

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Категории</h1>
                <p class="lead text-muted">
                    Обзор категорий товаров: найдите все, что вам нужно, из широкого ассортимента продуктов в нашем каталоге категорий
                </p>
                <p>
                    <a href="{{ route('products.byCategory', 'all') }}" class="btn btn-outline-secondary">Все товары</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($categories as $ctg)
                    <div class="col-md-4 col-sm-6">
                        <div class="card mb-30">
                            <a class="card-img-tiles" href="#" data-abc="true">
                                <div class="inner">
                                    <div class="main-img"><img src="{{ $ctg['image_url'] }}" alt="{{ $ctg['name'] }}"></div>
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title">
                                    {{ $ctg['name'] }}
                                </h4>

                                <p class="text-muted">
                                    От {{ number_format((float)$ctg['min_price'], 2, ',', ' ') }} ₽
                                </p>

                                <a class="btn btn-outline-primary btn-sm" href="{{ route('products.byCategory', $ctg['id']) }}" data-abc="true">
                                    Смотреть
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
