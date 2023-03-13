@extends('layouts.admin-master', ['navbar' => 'orders', 'pageTitle' => 'Заказы'])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            {!! $orders->links('admin.orders.partials.paginator') !!}
        </div>
    </div>
@endsection

@section('content')
    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">От кого</th>
                <th scope="col">Сумма</th>
                <th scope="col">Создан</th>
                <th scope="col">Изменен</th>
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
                        {{ $order->name }} {{ mb_substr($order->surname, 0, 1) }}.
                    </td>
                    <td>
                        {{ number_format($prices[$order->id], 2, ',', ' ') }} ₽
                    </td>
                    <td>
                        {{ date('d.m.Y H:i:s', strtotime($order->submitted_at)) }}
                    </td>
                    <td>
                        {{ date('d.m.Y H:i:s', strtotime($order->updated_at)) }}
                    </td>
                    <td>
                        @switch($order->checkout)
                            @case(0)
                                <span data-feather="x" style="stroke: #ff0000" class="align-text-bottom"></span>
                                @break

                            @case(1)
                                <span data-feather="clock" style="stroke: #f8c555" class="align-text-bottom"></span>
                                @break

                            @case(2)
                                <span data-feather="check" style="stroke: #1c7430" class="align-text-bottom"></span>
                                @break

                            @case(3)
                                <span data-feather="eye-off" class="align-text-bottom"></span>
                                @break

                            @default
                                <span data-feather="x" class="align-text-bottom"></span>
                                @break
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.item', ['order' => $order]) }}" role="button" class="btn btn-outline-secondary btn-sm">
                            Открыть
                        </a>
                        @if($order->checkout != 2)
                            <form style="display: inline-block" action="{{ route('admin.orders.confirm') }}" method="post">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="order_id" value="{{ $order->id }}" />

                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    Подтвердить
                                </button>
                            </form>
                        @endif
                        @if($order->checkout != 3)
                            <form style="display: inline-block" action="{{ route('admin.orders.cancel') }}" method="post">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="order_id" value="{{ $order->id }}" />

                                <button type="submit" class="btn btn-outline-warning btn-sm">
                                    Отменить
                                </button>
                            </form>
                        @endif
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "MDO{$order->id}" }}">
                            Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach($orders as $order)
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
    @endforeach
@endsection
