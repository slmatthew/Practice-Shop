@extends('app', ['navbar' => 'products', 'css' => ['allctgs.css']])

@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <div class="mb-3">
                <img src="{{ $brand->image }}" alt="{{ $brand->name }}" class="img-thumbnail rounded" style="height: 15rem">
            </div>
            <h1 class="display-4 fw-normal">{{ $brand->name }}</h1>
            <p class="lead fw-normal">{{ $brand->description }}</p>
{{--            <a class="btn btn-outline-secondary" href="#">Coming soon</a>--}}
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
{{--    @if(!empty($categories))--}}
{{--            @foreach($categories as $line)--}}
{{--                <div class="d-md-flex flex-md-equal w-100 my-3">--}}
{{--                    @foreach($line as $ctg)--}}
{{--                        <div class="{{ $ctg->id % 2 ? 'bg-light' : 'text-bg-dark' }} w-100 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">--}}
{{--                            <div class="my-3 p-3">--}}
{{--                                <h2 class="display-5">{{ $ctg->name }}</h2>--}}
{{--                                <a href="{{ route('products.byCategory', ['category' => $ctg, 'brand' => $brand]) }}" class="btn btn-outline-{{ $ctg->id % 2 ? 'secondary' : 'light' }}" role="button">Смотреть</a>--}}
{{--                                <div class="my-3 d-flex justify-content-center w-100">--}}
{{--                                    <div style="width:80%">--}}
{{--                                        <img src="{{ $ctg->image_url }}" alt="{{ $ctg->name }}" class="img-thumbnail rounded">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--    @endif--}}
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($categories as $ctg)
                    <div class="col-md-4 col-sm-6">
                        <div class="card mb-30">
                            <a class="card-img-tiles" href="#" data-abc="true">
                                <div class="inner">
                                    <div class="main-img"><img src="{{ $ctg->image_url }}" alt="{{ $ctg->name }}"></div>
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h4 class="card-title">
                                    {{ $ctg->name }}
                                </h4>

                                <p class="text-muted">
                                    От {{ number_format((float)$ctg->min_price, 2, ',', ' ') }} ₽
                                </p>

                                <a class="btn btn-outline-primary btn-sm" href="{{ route('products.byCategory', ['category' => $ctg, 'brand' => $brand]) }}" data-abc="true">
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
