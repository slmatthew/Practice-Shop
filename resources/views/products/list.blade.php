@extends('app', ['navbar' => 'products'])

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{ $all ? 'Все товары' : $ctgName }}</h1>
                <p class="lead text-muted">
                    @if(rand()&1 == 1)
                        На этой странице представлены все товары {{ $all ? '' : 'этой категории' }}
                    @else
                        Здесь вы найдете все {{ $all ? 'товары' : mb_strtolower($ctgName) }}, представленные в магазине
                    @endif
                </p>
                <p>
                    <a href="{{ route('products.categories') }}" class="btn btn-outline-secondary">К категориям</a>
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
@endsection
