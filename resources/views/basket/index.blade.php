@extends('app', ['navbar' => 'basket'])

@section('content')
    <div class="container">
        @if(empty($basketItems))
            <section class="py-5 text-center container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light">Ваша корзина пуста</h1>
                        <p class="lead text-muted">Хорошо, что это исправимо, правда?</p>
                        @auth
                            <p>
                                <a href="{{ route('products.categories') }}" role="button" class="btn btn-outline-primary my-2">Исправить это!</a>
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
                    @endphp
                    @foreach($basketItems as $item)
                        @php
                            if($item['product']['available']) {
                                $total_cost += $item['product']['price'] * $item['quantity'];
                                $total_quantity += $item['quantity'];
                            }
                        @endphp
                        <tr>
                            @csrf
                            @method('POST')

                            <th scope="row">
                                <a href="{{ route('products.item', $item['product']['id']) }}" target="_blank">
                                    <img src="{{ $item['product']['image_url'] }}" style="max-width: 5em;max-height: 5em" class="img-thumbnail rounded float-start">
                                </a>
                            </th>
                            <td class="align-middle">
                                <a href="{{ route('products.item', $item['product']['id']) }}" target="_blank">
                                    {{ $item['product']['name'] }}
                                </a>
                            </td>
                            <td class="align-middle">
                                {{ $item['quantity'] }}
                            </td>
                            <td class="align-middle">
                                @if($item['product']['available'])
                                    <span>{{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }} ₽</span>
                                @else
                                    <span>нет в наличии</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalQuantity{{ $item['product']['id'] }}">
                                    Изменить
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item['product']['id'] }}">
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
                            {{ number_format($total_cost, 2, ',', ' ') }} ₽
                        </td>
                        <td>
                            <a href="{{ route('basket.checkout') }}" role="button" class="btn btn-outline-primary btn-sm">Оформить заказ</a>
                            <a href="{{ route('basket.clear') }}" role="button" class="btn btn-outline-danger btn-sm">Очистить</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @foreach($basketItems as $item)
        @include('basket.modals.editQuantity', ['item' => $item])
        @include('basket.modals.delete', ['item' => $item])
    @endforeach
@endsection
