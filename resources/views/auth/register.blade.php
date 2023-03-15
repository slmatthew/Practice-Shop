@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('register.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Денис" required="required" autofocus>
            <label for="floatingName">Имя</label>
            @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="surname" value="{{ old('surname') }}" placeholder="Петров" required="required" autofocus>
            <label for="floatingName">Фамилия</label>
            @if ($errors->has('surname'))
                <span class="text-danger text-left">{{ $errors->first('surname') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Имя пользователя" required="required" autofocus>
            <label for="floatingName">Имя пользователя</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Пароль" required="required">
            <label for="floatingPassword">Пароль</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Подтверждение пароля" required="required">
            <label for="floatingConfirmPassword">Подтверждение пароля</label>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Зарегистрироваться</button>

        <p class="mt-5 mb-3 text-muted"><a href="{{ route('main') }}" role="button">Вернуться на главную</a></p>

        @include('auth.partials.copy')
    </form>
@endsection
