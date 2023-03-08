@extends('layouts.admin-master', ['navbar' => 'products', 'pageTitle' => 'Ошибка'])

@section('content')
    <div class="container">

        <div class="alert alert-danger" role="alert">
            Произошла ошибка при добавлении товара
        </div>

        <div class="d-grid gap-2">
            <a href="{{ route('admin.products') }}" role="link" class="w-100 btn btn-lg btn-outline-primary" type="submit">Список всех товаров</a>
            <a href="{{ route('admin.product.add') }}" role="link" class="w-100 btn btn-lg btn-outline-secondary" type="submit">Назад</a>
        </div>

    </div>
@endsection
