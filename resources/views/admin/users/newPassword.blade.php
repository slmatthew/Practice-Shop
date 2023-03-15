@extends('layouts.admin-master', ['navbar' => 'users', 'pageTitle' => 'Результат'])

@section('content')
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Пароль сброшен</h4>
        <p>Вы успешно сбросили пароль пользователя #{{ $user->id }} {{ $user->name }} {{ $user->surname }}</p>
        <hr>
        <p class="mb-0">Новый пароль: {{ $password }}</p>
    </div>
@endsection
