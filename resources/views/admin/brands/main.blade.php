@extends('layouts.admin-master', ['navbar' => 'brands', 'pageTitle' => 'Бренды'])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a role="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddBrand">Добавить</a>
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
            <th scope="col">Обложка</th>
            <th scope="col">Название</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @if($brands->count() == 0)
            <tr>
                <td colspan="4">
                    Нет брендов
                </td>
            </tr>
        @endif

        @foreach($brands as $brand)
            <tr>
                <th scope="row">
                    {{ $brand->id }}
                </th>
                <td>
                    <img src="{{ $brand->image }}" style="max-width: 5em;max-height: 5em" class="img-thumbnail rounded float-start">
                </td>
                <td>{{ $brand->name }}</td>
                <td>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "mBrandUpd{$brand->id}" }}">
                        Изменить
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "mBrandDel{$brand->id}" }}">
                        Удалить
                    </button>
                </td>
            </tr>

            @include('admin.brands.partial.updateModal', ['brand' => $brand])
            @include('admin.brands.partial.deleteModal', ['brand' => $brand])
        @endforeach
        </tbody>
    </table>

    @include('admin.brands.partial.addModal')
@endsection
