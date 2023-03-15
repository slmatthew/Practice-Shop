@extends('app', ['navbar' => ''])

@section('content')
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div id="colorEditable" class="rounded-top text-white d-flex flex-row" style="background-color: {{ $user['id'] == 1 ? '#957DAD' : '#000' }}; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="{{ $user->image }}"
                                     alt="{{ "@{$user->username}" }} image" class="img-fluid img-thumbnail mt-4 mb-2"
                                     style="width: 150px; z-index: 1">
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5 id="nameSurnameEditable">{{ "{$user->name}  {$user->surname}" }}</h5>
                                <p id="usernameEditable">{{ "@{$user->username}" }}</p>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <a href="{{ route('user.orders') }}" style="text-decoration: none; color: inherit">
                                    <div>
                                        <p class="mb-1 h5">{{ number_format($orders_count, 0, '', ' ') }}</p>
                                        <p class="small text-muted mb-0">{{ trans_choice('заказ|заказа|заказов', $orders_count) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <form method="post" action="{{ route('user.edit.action') }}" enctype="multipart/form-data">

            @csrf
            @method('POST')

            <input type="hidden" name="_user_id" value="{{ $user->id }}" />

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pName">Имя</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="Денис" value="{{ $user->name ?? '' }}" id="pName" required>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pSurname">Фамилия</label>
                <div class="col-sm-10">
                    <input name="surname" type="text" class="form-control" placeholder="Петров" value="{{ $user->surname ?? '' }}" id="pSurname" required>
                    @if ($errors->has('surname'))
                        <span class="text-danger text-left">{{ $errors->first('surname') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-2 col-form-label">
                    <label for="pPhone">Телефон</label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-text">7</span>
                        <input type="tel" class="form-control" name="phone" id="pPhone" pattern="[0-9]{10}" placeholder="9991234567" value="{{ $user->phone ?? '' }}">
                    </div>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pImage">Изображение</label>
                <div class="col-sm-10">
                    <input name="image" type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="pImage">
                    @if ($errors->has('image'))
                        <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                    @endif
                    {{--                    <br />--}}
                    {{--                    <img src="{{ $product['image_url'] }}" style="max-width: 20em;max-height: 20em" class="img-thumbnail rounded float-start" alt="...">--}}
                </div>
            </div>

{{--            <div class="mb-3 row">--}}
{{--                <label class="col-sm-2 col-form-label" for="pColor">Цвет обложки</label>--}}
{{--                <div class="col-sm-10">--}}
{{--                    <input type="color" class="form-control" name="color" id="pColor" value="{{ $user->id == 1 ? '#957DAD' : '#000' }}">--}}
{{--                </div>--}}
{{--            </div>--}}

            <hr class="my-4" />

            <div class="mb-3 row">
                <div class="col-sm-2 col-form-label">
                    <label for="pUsername">Логин</label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input name="username" type="text" class="form-control" placeholder="slmatthew" value="{{ $user->username ?? '' }}" id="pUsername" required>
                    </div>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="aNewPassword">Новый пароль <small class="text-muted">(необязательно)</small></label>
                <div class="col-sm-10">
                    <input name="new_password" type="password" class="form-control" placeholder="Пароль" value="" id="aNewPassword" autocomplete="off">
                    @if ($errors->has('new_password'))
                        <span class="text-danger text-left">{{ $errors->first('new_password') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="aNewPasswordConfirmation">Подтверждение пароля <small class="text-muted">(необязательно)</small></label>
                <div class="col-sm-10">
                    <input name="new_password_confirmation" type="password" class="form-control" placeholder="Подтверждение пароля" value="" id="aNewPasswordConfirmation" autocomplete="off">
                    @if ($errors->has('new_password'))
                        <span class="text-danger text-left">{{ $errors->first('new_password') }}</span>
                    @endif
                </div>
            </div>

            <hr class="my-4" />

            <div class="mb-3 row">
                <div class="col-sm-2 col-form-label"></div>
                <div class="col-sm-10">
                    <button class="btn btn-sm btn-outline-primary" type="submit">Сохранить</button>
                    <a href="{{ route('user.me') }}" role="link" class="btn btn-sm btn-outline-danger" type="submit">Отменить</a>
                </div>
            </div>

        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        document.getElementById('pName').onkeyup = function () {
            document.getElementById('nameSurnameEditable').innerHTML  = `${this.value} ${document.getElementById('pSurname').value}`;
        };

        document.getElementById('pSurname').onkeyup = function () {
            document.getElementById('nameSurnameEditable').innerHTML  = `${document.getElementById('pName').value} ${this.value}`;
        };

        document.getElementById('pUsername').onkeyup = function () {
            document.getElementById('usernameEditable').innerHTML  = `@${this.value}`;
        };

        // document.querySelector('#pColor').addEventListener('change', e => {
        //     document.querySelector('#colorEditable').style.backgroundColor = e.target.value;
        // }, false);
    </script>
@endsection
