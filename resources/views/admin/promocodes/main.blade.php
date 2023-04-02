@extends('layouts.admin-master', ['navbar' => 'promocodes', 'pageTitle' => 'Промокоды'])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a role="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddPC">Добавить</a>
        </div>
    </div>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Промокод</th>
                <th scope="col">Скидка (% от стоимости заказа)</th>
                <th scope="col">Создан</th>
                <th scope="col">Статус</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            @if(!$promocodes->count())
                <tr>
                    <td colspan="6">
                        Нет промокодов
                    </td>
                </tr>
            @else
                @foreach($promocodes as $pc)
                    <tr>
                        <th scope="row">
                            {{ $pc->id }}
                        </th>
                        <td>
                            {{ $pc->promocode }}
                        </td>
                        <td>
                            {{ $pc->discount }}
                        </td>
                        <td>
                            {{ date('d.m.Y H:i:s', strtotime($pc->created_at)) }}
                        </td>
                        <td>
                            @if($pc->limit_exceeded)
                                <span class="badge rounded-pill text-bg-secondary">активации закончились</span>
                            @elseif($pc->expired)
                                <span class="badge rounded-pill text-bg-secondary">просрочен</span>
                            @else
                                <span class="badge rounded-pill text-bg-primary">активен</span>
                            @endif
                        </td>
                        <td>


                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @include('admin.promocodes.partials.addModal')
@endsection
