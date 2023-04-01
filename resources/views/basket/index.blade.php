@extends('app', ['navbar' => 'basket'])

@section('content')
    <div class="container">
        @if(empty($basketItems))
            <section class="py-5 text-center container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light">Ваша корзина пуста</h1>
                        <p class="lead text-muted">
                            {{ Request::has('checkout') ? 'Спасибо! Номер вашего заказа: '.Request::get('checkout') : 'Хорошо, что это исправимо, правда?' }}
                        </p>
                        @auth
                            <p>
                                <a href="{{ route('products.categories') }}" role="button" class="btn btn-outline-primary my-2">
                                    {{ Request::has('checkout') ? 'Вернуться к товарам' : 'Исправить это!' }}
                                </a>
                            </p>
                        @endauth
                    </div>
                </div>
            </section>
        @else
            <h2>
                Корзина
            </h2>

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

            <div>
                <table class="table table-responsive align-middle">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Название</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $total_cost = 0;
                        $total_quantity = 0;
                        $has_discounted = false;
                    @endphp
                    @foreach($basketItems as $item)
                        @php
                            if($item['product']['available']) {
                                $total_cost += $item['price'] * $item['quantity'];
                                $total_quantity += $item['quantity'];
                            }

                            if(!$has_discounted && !$item->isPriceActual()) $has_discounted = true;
                        @endphp
                        <tr>
                            @csrf
                            @method('POST')

                            <th scope="row">
                                <a href="{{ route('products.item', $item['product']) }}" target="_blank">
                                    <img src="{{ $item['product']->image_url }}" style="max-width: 5em;max-height: 5em" class="img-thumbnail rounded float-start">
                                </a>
                            </th>
                            <td class="align-middle">
                                {{ Auth::user()->isAdmin() ? $item['id'] : '' }}
                                <a href="{{ route('products.item', $item['product']) }}" target="_blank">
                                    {{ $item['product']->name }}
                                </a>
                            </td>
                            <td class="align-middle">
                                {{ $item['quantity'] }}
                            </td>
                            <td class="align-middle">
                                {{ $item['product']->available ? App\Models\Product::formatPrice($item['price'] * $item['quantity']) : 'нет в наличии' }}
                                @if($item->hasDiscountedPrice())
                                    <span class="badge rounded-pill bg-danger me-1">
                                        -{{ $item->getDiscountPercent() }}%
                                    </span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalQuantity{{ $item['id'] }}">
                                    Изменить
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item['id'] }}">
                                    Удалить
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td>
                            Всего
                        </td>
                        <td>
                            {{ $total_quantity }}
                        </td>
                        <td>
                            {{ App\Models\Product::formatPrice($total_cost) }}
                        </td>
                        <td>
                            <a href="{{ route('basket.checkout') }}" role="button" class="btn btn-outline-primary btn-sm">Оформить заказ</a>
                            <a href="{{ route('basket.clear') }}" role="button" class="btn btn-outline-danger btn-sm">Очистить</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            @if($has_discounted)
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Обратите внимание!</h4>
                    Цены на некоторые товары в вашей корзине изменились. Однако, вы все еще можете приобрести эти товары по старой цене. Будьте внимательны: любые изменения в количестве товаров приведут к обновлению цен
                </div>
            @endif
        @endif
    </div>

    @foreach($basketItems as $item)
        @include('basket.modals.editQuantity', ['item' => $item])
        @include('basket.modals.delete', ['item' => $item])
    @endforeach
@endsection
