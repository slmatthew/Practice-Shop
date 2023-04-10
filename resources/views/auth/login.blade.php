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

        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Войти</button>

        <div class="form-floating" id="vkid"></div>

        <p class="mt-5 mb-3 text-muted"><a href="{{ route('main') }}" role="button">Вернуться на главную</a></p>

        @include('auth.partials.copy')
    </form>

    <script src="https://unpkg.com/@vkontakte/superappkit@1.57.0/dist/index-umd.js"></script>
    <script>
        const { Connect, Config, ConnectEvents } = window.SuperAppKit;

        function redirectPost(url, data) {
            var form = document.createElement('form');
            document.body.appendChild(form);
            form.method = 'post';
            form.action = url;

            var csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = "{{ csrf_token() }}";
            form.appendChild(csrf);

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'vk_data';
            input.value = JSON.stringify(data);
            form.appendChild(input);

            form.submit();
        }

        Config.init({
            appId: 51608129, // идентификатор приложения
            /*appSettings: {
                agreements: '',
                promo: '',
                vkc_behavior: '',
                vkc_auth_action: '',
                vkc_brand: '',
                vkc_display_mode: '',
            },*/
        });

        const oneTapButton = Connect.buttonOneTapAuth({
            callback: (event) => {
                const { type } = event;

                if (!type) {
                    return;
                }

                switch (type) {
                    case ConnectEvents.OneTapAuthEventsSDK.LOGIN_SUCCESS: // = 'VKSDKOneTapAuthLoginSuccess'
                        console.log(event);
                        redirectPost('{{ route('login.vk') }}', event.payload);
                        return;
                    // Для этих событий нужно открыть полноценный VK ID чтобы
                    // пользователь дорегистрировался или подтвердил телефон
                    case ConnectEvents.OneTapAuthEventsSDK.FULL_AUTH_NEEDED: //  = 'VKSDKOneTapAuthFullAuthNeeded'
                    case ConnectEvents.OneTapAuthEventsSDK.PHONE_VALIDATION_NEEDED: // = 'VKSDKOneTapAuthPhoneValidationNeeded'
                    case ConnectEvents.ButtonOneTapAuthEventsSDK.SHOW_LOGIN: // = 'VKSDKButtonOneTapAuthShowLogin'
                        // url - строка с url, на который будет произведён редирект после авторизации.
                        // state - состояние вашего приложение или любая произвольная строка, которая будет добавлена к url после авторизации.
                        return Connect.redirectAuth({ url: 'https://up11.slmatthew.ru/vape', state: 'pisun'});
                    // Пользователь перешел по кнопке "Войти другим способом"
                    case ConnectEvents.ButtonOneTapAuthEventsSDK.SHOW_LOGIN_OPTIONS: // = 'VKSDKButtonOneTapAuthShowLoginOptions'
                        // Параметр screen: phone позволяет сразу открыть окно ввода телефона в VK ID
                        // Параметр url: ссылка для перехода после авторизации. Должен иметь https схему. Обязательный параметр.
                        return Connect.redirectAuth({ screen: 'phone', url: 'https://up11.slmatthew.ru/vape' });
                }

                return;
            },
            // Не обязательный параметр с настройками отображения OneTap
            options: {
                showAlternativeLogin: false,
                showAgreements: false,
                displayMode: 'default',
                langId: 0,
                buttonSkin: 'flat',
                buttonStyles: {
                    borderRadius: 8,
                    height: 50,
                },
            },
        });

        // Получить iframe можно с помощью метода getFrame()
        if (oneTapButton) {
            document.querySelector('#vkid').appendChild(oneTapButton.getFrame());
        }

        // Удалить iframe можно с помощью OneTapButton.destroy();

    </script>
@endsection
