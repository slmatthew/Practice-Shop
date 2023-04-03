@extends('app', ['navbar' => ''])

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.user', ['user' => Auth::user()->id]) }}">{{ Auth::user()->username }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Заказы</li>
            </ol>
        </nav>

        @if($orders->count())
            <style>
                .feather {
                    width: 16px;
                    height: 16px;
                }
            </style>
            <table class="table align-middle">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">
                            {{ $order->id }}
                        </th>
                        <td>
                            {{ App\Models\Product::formatPrice($order->final_price) }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($order->submitted_at, 'Europe/Moscow')->locale('ru-RU')->format('d.m.Y в H:i') }}
                        </td>
                        <td>
                            <div class="align-items-center">
                                @switch($order->checkout)
                                    @case(0)
                                        <span class="badge text-bg-danger">Корзина</span>
                                        @break

                                    @case(1)
                                        <span class="badge text-bg-warning">На рассмотрении</span>
                                        @break

                                    @case(2)
                                        <span class="badge text-bg-success">Подтвержден</span>
                                        @break

                                    @case(3)
                                        <span class="badge text-bg-secondary">Отменен</span>
                                        @break

                                    @default
                                        <span class="badge text-bg-dark">Неизвестно</span>
                                        @break
                                @endswitch
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('user.order', ['order' => $order]) }}" role="button" class="btn btn-outline-secondary btn-sm">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <section class="py-5 text-center container">
                <div class="row py-lg-5">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light">История заказов пуста</h1>
                        <p class="lead text-muted">
                            Хорошо, что это исправимо, правда?
                        </p>
                        @auth
                            <p>
                                <a href="{{ route('products.categories') }}" role="button" class="btn btn-outline-primary my-2">
                                    Исправить это!
                                </a>
                            </p>
                        @endauth
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
