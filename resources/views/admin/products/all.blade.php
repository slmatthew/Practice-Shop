@extends('layouts.admin-master', ['navbar' => 'products'])

@section('content')
    <div class="container">

        <table class="table">
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
                    <th scope="row">{{ $product['id'] }}</th>
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
                        <a href="{{ route('admin.product', $product['id']) }}" role="button" class="btn btn-outline-primary btn-sm">Изменить</a>
                        <a href="{{ route('admin.product.delete', $product['id']) }}" role="button" class="btn btn-outline-danger btn-sm">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
