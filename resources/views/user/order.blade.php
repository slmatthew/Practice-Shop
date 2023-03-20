@extends('app', ['navbar' => ''])

@section('content')
    <style>
        .feather {
            width: 16px;
            height: 16px;
        }
    </style>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.user', ['user' => Auth::user()]) }}">{{ Auth::user()->username }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.orders') }}">Заказы</a></li>
                <li class="breadcrumb-item active" aria-current="page">Заказ {{ $order->id }}</li>
            </ol>
        </nav>

        <h2 class="h3">Товары</h2>

        <table class="table table-responsive align-middle">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Название</th>
                <th scope="col">Количество</th>
                <th scope="col">Цена</th>
            </tr>
            </thead>
            <tbody>
            @php
                $total_cost = 0;
                $total_quantity = 0;
            @endphp
            @foreach($orderItems as $item)
                @php
                    if($item->product->available) {
                        $total_cost += $item->product->price * $item->quantity;
                        $total_quantity += $item->quantity;
                    }
                @endphp
                <tr>
                    @csrf
                    @method('POST')

                    <th scope="row">
                        <a href="{{ route('products.item', $item->product) }}" target="_blank">
                            <img src="{{ $item->product->image_url }}" style="max-width: 5em;max-height: 5em" class="img-thumbnail rounded float-start">
                        </a>
                    </th>
                    <td class="align-middle">
                        <a href="{{ route('products.item', $item->product) }}" target="_blank">
                            {{ $item->product->name }}
                        </a>
                    </td>
                    <td class="align-middle">
                        {{ $item->quantity }}
                    </td>
                    <td class="align-middle">
                        @if($item->product->available)
                            <span>{{ number_format($item->product->price * $item->quantity, 2, ',', ' ') }} ₽</span>
                        @else
                            <span>нет в наличии</span>
                        @endif
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
            </tr>
            </tbody>
        </table>

        <h2 class="h3">Контактная информация</h2>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="name">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="name" value="{{ $order->name }}" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="surname">Фамилия</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="surname" value="{{ $order->surname }}" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="phone">Номер телефона</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="phone" value="{{ '7'.$order->phone }}" readonly>
            </div>
        </div>

        <hr class="my-4" />

        <div class="row">
            <label class="col-sm-2 col-form-label" for="phone">Статус</label>
            <div class="col-sm-10">
                @switch($order->checkout)
                    @case(1)
                        <span data-feather="clock" style="stroke: #f8c555" class="align-text-bottom"></span>
                        На рассмотрении
                        @break

                    @case(2)
                        <span data-feather="check" style="stroke: #1c7430" class="align-text-bottom"></span>
                        Подтвержден
                        @break

                    @case(3)
                        <span data-feather="eye-off" class="align-text-bottom"></span>
                        Отменен
                        @break

                    @default
                        <span data-feather="x" class="align-text-bottom"></span>
                        @break
                @endswitch
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script>
        (() => {
            'use strict'

            feather.replace({ 'aria-hidden': 'true' })
        })()
    </script>
@endsection
