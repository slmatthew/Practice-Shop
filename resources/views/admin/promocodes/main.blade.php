@extends('layouts.admin-master', ['navbar' => 'promocodes', 'pageTitle' => 'Промокоды'])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="me-2">
            <a role="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddPC">Добавить</a>
            @if($promocodes->count())
                <a role="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#mTruncatePC">Очистить</a>
            @endif
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
                <th scope="col">Скидка</th>
                <th scope="col">Создан</th>
                <th scope="col">Статус</th>
                <th scope="col">Использований</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            @if(!$promocodes->count())
                <tr>
                    <td colspan="7">
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
                            {{ $pc->discount }} %
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
                                @if(!!$pc->expires_at)
                                    <span class="badge rounded-pill text-bg-light">
                                        до {{ \Carbon\Carbon::parse($pc->expires_at, 'Europe/Moscow')->format('d.m.Y') }}
                                    </span>
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ $pc->usersPromocodes()->count() }}
                            @if($pc->activation_limit > 0)
                                / {{ $pc->activation_limit }}
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#mPCDel{{ $pc->id }}">
                                Удалить
                            </button>
                        </td>
                    </tr>

                    @include('admin.promocodes.partials.deleteModal', ['promocode' => $pc])
                @endforeach
            @endif
        </tbody>
    </table>

    @include('admin.promocodes.partials.addModal')
    @include('admin.promocodes.partials.clearModal')
@endsection
