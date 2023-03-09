@extends('layouts.admin-master', ['navbar' => 'users', 'pageTitle' => 'Пользователи'])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a role="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddCtg">Добавить</a>
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
            <th scope="col">Имя</th>
            <th scope="col">Роль</th>
            <th scope="col">Дата регистрации</th>
            <th scope="col">Дата изменения</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">
                    <img src="{{ $user['image'] }}" width="32" height="32" class="rounded-circle float-start">
                </th>
                <td>{{ $user['username'] }}</td>
                <td>{{ $user['role'] == 'user' ? 'обычный' : 'админ' }}</td>
                <td>{{ date('d.m.Y H:i:s', strtotime($user['created_at'])) }}</td>
                <td>{{ date('d.m.Y H:i:s', strtotime($user['updated_at'])) }}</td>
                <td>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#">
                        Изменить
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#">
                        Удалить
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

{{--    @foreach($categories as $ctg)--}}
{{--        @include('admin.categories.partial.updateModal', [...$ctg])--}}
{{--        @include('admin.partials.modalDelete', ['action' => route('admin.category.delete'), 'id' => $ctg['id'], 'category' => $ctg])--}}
{{--    @endforeach--}}

{{--    @include('admin.categories.partial.addModal')--}}
@endsection
