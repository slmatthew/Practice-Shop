@extends('layouts.admin-master', ['navbar' => 'categories', 'pageTitle' => 'Категории'])

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
            <th scope="col">Название</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $ctg)
            <tr>
                <th scope="row">
                    {{ $ctg['id'] }}
                </th>
                <td>{{ $ctg['name'] }}</td>
                <td>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "MUP{$ctg['id']}" }}">
                        Изменить
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "mdpc{$ctg['id']}" }}">
                        Удалить
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($categories as $ctg)
        @include('admin.categories.partial.updateModal', [...$ctg])
        @include('admin.partials.modalDelete', ['action' => route('admin.category.delete'), 'id' => $ctg['id'], 'category' => $ctg])
    @endforeach

    @include('admin.categories.partial.addModal')
@endsection
