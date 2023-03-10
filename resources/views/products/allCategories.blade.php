@extends('app', ['navbar' => 'products', 'css' => ['allctgs.css']])

@section('content')
    <div class="container mt-100">
        <div class="row">
            @foreach($categories as $ctg)
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-30"><a class="card-img-tiles" href="#" data-abc="true">
                            <div class="inner">
                                <div class="main-img"><img src="{{ $ctg['products'][0]['image_url'] }}" alt="Category"></div>
                                @isset($ctg['products'][1])
                                    <div class="thumblist">
                                        <img src="{{ $ctg['products'][1]['image_url'] }}" alt="Category">
                                        @isset($ctg['products'][2])
                                            <img src="{{ $ctg['products'][2]['image_url'] }}" alt="Category">
                                        @endisset
                                    </div>
                                @endisset
                            </div></a>
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $ctg['name'] }}</h4>
                            <p class="text-muted">От {{ number_format((float)$ctg['min_price'], 2, ',', ' ') }} ₽</p><a class="btn btn-outline-primary btn-sm" href="{{ route('products') }}" data-abc="true">Смотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
