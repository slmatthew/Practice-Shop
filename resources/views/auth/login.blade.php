@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <h1 class="h3 mb-3 fw-normal">Авторизация</h1>

        @include('layouts.partials.messages')

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="akimkakim" required="required" autofocus>
            <label for="floatingInput">Имя пользователя</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="12345678" required="required">
            <label for="floatingPassword">Пароль</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

{{--        <div class="checkbox mb-3">--}}
{{--            <label>--}}
{{--                <input type="checkbox" value="remember-me"> Запомнить--}}
{{--            </label>--}}
{{--        </div>--}}

        <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>

        <p class="mt-5 mb-3 text-muted"><a href="{{ route('main') }}" role="button">Вернуться на главную</a></p>

        @include('auth.partials.copy')
    </form>
@endsection
