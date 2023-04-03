@extends('layouts.admin-master', ['navbar' => 'orders', 'pageTitle' => 'Заказ #'.$order->id])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a role="button" class="btn btn-outline-primary btn-sm" href="{{ route('user.user', ['user' => $user]) }}" target="_blank">
                Открыть профиль
            </a>
        </div>
        <div class="btn-group me-2">
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "MDO{$order->id}" }}">
                Удалить
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div>
        <table class="table table-responsive align-middle">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
                <th scope="col">Общая цена</th>
            </tr>
            </thead>
            <tbody>
            @php
                $total_cost = 0;
                $total_quantity = 0;
            @endphp
            @foreach($orderItems as $item)
                @php
                    if($item['product']['available']) {
                        $total_cost += $item['price'] * $item['quantity'];
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
                        {{ $item['product']['available'] ? App\Models\Product::formatPrice($item['price']) : 'нет в наличии' }}
                    </td>
                    <td class="align-middle">
                        {{ $item['quantity'] }}
                    </td>
                    <td class="align-middle">
                        {{ $item['product']['available'] ? App\Models\Product::formatPrice($item['price'] * $item['quantity']) : 'нет в наличии' }}
                    </td>
                </tr>
            @endforeach
            @if($order->discounted)
                <tr>
                    <th scope="row"></th>
                    <td>
                        Промокод
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        -{{ App\Models\Product::formatPrice($total_cost - $order->final_price) }}
                    </td>
                </tr>
            @endif
            <tr>
                <th scope="row"></th>
                <td>
                    Всего
                </td>
                <td></td>
                <td>
                    {{ $total_quantity }}
                </td>
                <td>
                    {{ App\Models\Product::formatPrice($order->final_price) }}
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

        @if($order->checkout != 0)
            <form>
                @csrf

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="status">Статус</label>
                    <div class="col-sm-10">
                        <select name="checkout" class="form-select" id="status" {{ $order->checkout == 3 ? 'disabled' : '' }}>
                            <option value="1" {{ $order->checkout == 1 ? 'selected' : '' }}>
                                На рассмотрении
                            </option>
                            <option value="2" {{ $order->checkout == 2 ? 'selected' : '' }}>
                                Подтвержден
                            </option>
                            <option value="3" {{ $order->checkout == 3 ? 'selected' : '' }}>
                                Отменен
                            </option>
                        </select>
                    </div>
                </div>

                @if($order->checkout != 3)
                    <div class="mb-3 row">
                        <div class="col-sm-2">
                            <button class="btn btn-outline-primary" type="submit">Сохранить</button>
                        </div>
                    </div>
                @endif
            </form>
        @endif

        <div class="modal fade" id="{{ "MDO{$order->id}" }}" tabindex="-1" aria-labelledby="{{ "MDOL{$order->id}" }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="{{ "MDOL{$order->id}" }}">{{ "Заказ #{$order->id}" }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <form style="display: inline-block" action="{{ route('admin.orders.delete') }}" method="post">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="order_id" value="{{ $order->id }}" />

                        <div class="modal-body">
                            Вы действительно хотите удалить заказ #{{ $order->id }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
