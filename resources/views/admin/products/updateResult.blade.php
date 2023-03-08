@extends('layouts.admin-master', ['navbar' => 'products', 'pageTitle' => 'Результат'])

@section('content')
    <div class="alert alert-{{ $success ? 'success' : 'danger' }}" role="alert">
        Товар #{{ $product }} {{ $success ? '' : 'не' }} был успешно обновлен
    </div>

    <div class="d-grid gap-2">
        <a href="{{ route('admin.products') }}" role="link" class="w-100 btn btn-lg btn-outline-primary" type="submit">Список всех товаров</a>
        <a href="{{ route('admin.product', $product) }}" role="link" class="w-100 btn btn-lg btn-outline-secondary" type="submit">Назад</a>
    </div>
@endsection
