@extends('app', ['navbar' => 'products'])

@section('content')
    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Каталог товаров</h1>
                    <p class="lead text-muted">Здесь вы найдете все доступные категории товаров</p>
                    <p>
                        <a href="#" class="btn btn-primary my-2">Зарегистрироваться</a>
                        <a href="#" class="btn btn-secondary my-2">Войти</a>
                    </p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        @if(!(bool)$product->hidden)
                            @include('layouts.partials.productCard', ['product' => $product])
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </main>
@endsection
