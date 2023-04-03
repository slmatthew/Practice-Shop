@extends('app', ['navbar' => ''])

@section('content')
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: {{ $user['id'] == 1 ? '#957DAD' : '#000' }}; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="{{ $user->image }}"
                                     alt="{{ "@{$user->username}" }} image" class="img-fluid img-thumbnail mt-4 mb-2"
                                     style="width: 150px; z-index: 1">
                                @if(Auth::check() && Auth::user()->id == $user->id)
                                    <a role="button" href="{{ route('user.edit') }}" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                            style="z-index: 1;">
                                        Редактировать
                                    </a>
                                @endif
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>{{ "{$user->name}  {$user->surname}" }}</h5>
                                <p>{{ "@{$user->username}" }}</p>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                @if(Auth::check() && $user->id == Auth::user()->id)
                                    <a href="{{ route('user.orders') }}" style="text-decoration: none; color: inherit">
                                        <div>
                                            <p class="mb-1 h5">{{ number_format($orders->count(), 0, '', ' ') }}</p>
                                            <p class="small text-muted mb-0">{{ trans_choice('заказ|заказа|заказов', $orders->count()) }}</p>
                                        </div>
                                    </a>
                                @elseif(Auth::check() && Auth::user()->isAdmin())
                                    <a href="{{ route('admin.orders.main', ['user_id' => $user->id]) }}" style="text-decoration: none; color: inherit">
                                        <div>
                                            <p class="mb-1 h5">{{ number_format($orders->count(), 0, '', ' ') }}</p>
                                            <p class="small text-muted mb-0">{{ trans_choice('заказ|заказа|заказов', $orders->count()) }}</p>
                                        </div>
                                    </a>
                                @else
                                    <div>
                                        <p class="mb-1 h5">{{ number_format($orders->count(), 0, '', ' ') }}</p>
                                        <p class="small text-muted mb-0">{{ trans_choice('заказ|заказа|заказов', $orders->count()) }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($orders->count())
                            <div class="card-body p-4 text-black">
                                <div>
                                    <p class="lead fw-normal mb-1">Недавние заказы</p>
                                    <div class="p-4" style="background-color: #f8f9fa;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Сумма</th>
                                                    <th scope="col">Дата</th>
                                                    <th scope="col">Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $i => $order)
                                                    @if($i == 3)
                                                        <tr>
                                                            <td colspan="4" class="text-center">
                                                                <a href="{{ route('user.orders') }}" target="_blank">
                                                                    Посмотреть еще
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @break
                                                    @endif
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $order->id }}
                                                        </th>
                                                        <td>
                                                            {{ number_format($order->final_price, 2, ',', ' ') }} ₽
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($order->submitted_at, 'Europe/Moscow')->locale('ru-RU')->format('d.m.Y в H:i') }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('user.order', $order) }}" target="_blank" role="button" class="btn btn-outline-secondary btn-sm">
                                                                Открыть
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
{{--                        <div class="card-body p-4 text-black">--}}
{{--                            <div>--}}
{{--                                <p class="lead fw-normal mb-1">About</p>--}}
{{--                                <div class="p-4" style="background-color: #f8f9fa;">--}}
{{--                                    <p class="font-italic mb-1">Web Developer</p>--}}
{{--                                    <p class="font-italic mb-1">Lives in New York</p>--}}
{{--                                    <p class="font-italic mb-0">Photographer</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
