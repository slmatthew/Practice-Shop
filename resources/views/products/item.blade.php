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
{{--                    <span class="me-1">--}}
{{--                        <del>$200</del>--}}
{{--                    </span>--}}
                    <span>{{ number_format($product->price, 2, ',', ' ') }} ₽</span>
                </p>

                <strong><p style="font-size: 20px;">{{ $product->name }}</p></strong>

                <p>{{ $product->description }}</p>

                <form class="d-flex justify-content-left">
                    <!-- Default input -->
                    <div class="form-outline me-1" style="width: 100px;">
                        <input type="number" value="1" class="form-control" />
                    </div>
                    <button class="btn btn-primary ms-1" type="submit">
                        В корзину
                    </button>
                </form>
            </div>
            <!--Content-->
        </div>
        <!--Grid column-->
    </div>
</div>
@endsection
