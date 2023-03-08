@extends('layouts.admin-master', ['navbar' => 'products', 'pageTitle' => 'Товары'])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.product.add') }}" role="button" class="btn btn-outline-primary btn-sm">Добавить</a>
        </div>
    </div>
@endsection

@section('content')

    @if(!empty($deleteResult))
        <div class="alert alert-{{ $deleteResult[0] ? 'success' : 'danger' }}" role="alert">
            Товар #{{ $deleteResult[1] }} ({{ $deleteResult[2] }}) {{ $deleteResult[0] ? '' : 'не' }} был удален
        </div>
    @endif

    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Категория</th>
            <th scope="col">Скрыт / в наличии</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">
                    <span class="placeholder"></span>
                    <img src="{{ $product['image_url'] }}" style="max-width: 5em;max-height: 5em" class="img-thumbnail rounded float-start">
                </th>
                <td>{{ $product['name'] }}</td>
                <td>
                    @if($product['category'][0])
                        <a href="{{ route('admin.category', $product['category'][1]->id) }}">{{ $product['category'][1]->name }}</a>
                    @else
                        нет
                    @endif
                </td>
                <td>{{ $product['hidden'] ? 'да' : 'нет' }} / {{ $product['available'] ? 'да' : 'нет' }}</td>
                <td>
                    <a href="{{ route('product', $product['id']) }}" target="_blank" role="button" class="btn btn-outline-secondary btn-sm">Открыть</a>
                    <a href="{{ route('admin.product', $product['id']) }}" role="button" class="btn btn-outline-primary btn-sm">Изменить</a>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "mdp{$product['id']}" }}">
                        Удалить
                    </button>
                    {{--                        <a href="{{ route('admin.product.delete', $product['id']) }}" role="button" class="btn btn-outline-danger btn-sm">Удалить</a>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($products as $product)
        @include('admin.products.partials.modalDelete', ['id' => $product['id'], 'product' => $product])
    @endforeach
@endsection
