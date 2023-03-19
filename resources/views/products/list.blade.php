@extends('app', ['navbar' => 'products'])

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{ $all ? 'Все товары' : $ctgName }}</h1>
                <p class="lead text-muted">
                    @if(!is_null($brand))
                        На этой странице представлены все {{ mb_strtolower($ctgName) }} бренда {{ $brand->name }}
                    @else
                        @if(rand()&1 == 1)
                            На этой странице представлены все товары {{ $all ? '' : 'этой категории' }}
                        @else
                            Здесь вы найдете все {{ $all ? 'товары' : mb_strtolower($ctgName) }}, представленные в магазине
                        @endif
                    @endif
                </p>
                <p>
                    @if(is_null($brand))
                        <a href="{{ route('products.categories') }}" class="btn btn-outline-secondary">К категориям</a>
                    @else
                        <a href="{{ route('products.brand', ['brand' => $brand]) }}" class="btn btn-outline-secondary">К бренду</a>
                    @endif
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="dropdown mb-3">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Сортировка
                    @if(Request::has('sort'))
                        @switch(Request::get('sort'))
                            @case('name')
                                по названию
                                @break
                            @case('price')
                                по цене
                                @break
                            @case('created_at')
                                по новизне
                                @break

                            @default
                                @break
                        @endswitch
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li>@sortablelink('name', 'По названию', [], ['class' => 'dropdown-item'])</li>
                    <li>@sortablelink('price', 'По цене', [], ['class' => 'dropdown-item'])</li>
                    <li>@sortablelink('created_at', 'По новизне', [], ['class' => 'dropdown-item'])</li>
                    @if(Request::has('sort'))
                        <li><a href="?" class="dropdown-item">Cбросить</a></li>
                    @endif
                </ul>
            </div>

            {!! $paginator->appends(Request::except('page'))->render() !!}

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-3">
                @foreach($products as $product)
                    @if(!(bool)$product->hidden)
                        @include('layouts.partials.productCard', ['product' => $product, 'brand' => $brands[$product->brand_id] ?? null])
                    @endif
                @endforeach
            </div>
            {!! $paginator->appends(Request::except('page'))->render() !!}
        </div>
    </div>
@endsection
