@extends('app', ['navbar' => 'basket'])

@section('content')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <div class="container">
        <div class="py-5 text-center">
{{--            <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">--}}
            <h2>Оформление заказа</h2>
{{--            <p class="lead"></p>--}}
        </div>

        @php
            $count = 0;
            $total_cost = 0;
            foreach($basketItems as $item) {
                if($item['product']['available']) {
                    $total_cost += $item['price'] * $item['quantity'];
                    $count += $item['quantity'];
                }
            }
        @endphp

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Корзина</span>
                    <span class="badge bg-primary rounded-pill">{{ $count }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($basketItems as $item)
                        @if($item['product']['available'])
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">
                                        {{ mb_strlen($item['product']->name) > 30 ? mb_substr($item['product']->name, 0, 27).'...' : $item['product']->name }}
                                    </h6>
                                    <small class="text-muted">
                                        {{ mb_strlen($item['product']['description']) > 25 ? mb_substr($item['product']['description'], 0, 25).'...' : $item['product']['description'] }}
                                    </small>
                                </div>
                                <span class="text-muted">
                                    {{ App\Models\Product::formatPrice($item['price'] * $item['quantity']) }}
                                </span>
                            </li>
                        @endif
                    @endforeach
                    <li id="pc-li-loaded" class="list-group-item d-flex justify-content-between bg-light" style="display:none!important">
                        <div class="text-success">
                            <h6 class="my-0" id="pc-li-header">Промокод</h6>
                            <small id="pc-li-pc">EXAMPLECODE</small>
                        </div>
                        <span class="text-success" id="pc-li-amount">−$5</span>
                    </li>

                    <li id="pc-li-loaded-error" class="list-group-item d-flex justify-content-between bg-light" style="display:none!important">
                        <div class="text-danger">
                            <h6 class="my-0">Промокод не действителен!</h6>
                            <small id="pc-error-text"></small>
                        </div>
                    </li>

                    <li id="pc-li-loading" class="list-group-item bg-light" style="display: none;">
                        <div>
                            <h6 class="my-0 placeholder-glow">
                                <span class="placeholder col-6"></span>
                            </h6>

                            <small class="placeholder-glow">
                                <span class="placeholder placeholder-sm col-7"></span>
                            </small>
                        </div>
                        <span></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Всего</span>
                        <strong id="totalCostText">{{ App\Models\Product::formatPrice($total_cost) }}</strong>
                        <input type="hidden" id="hidden-total-cost" value="{{ $total_cost }}">
                    </li>
                </ul>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Промокод" id="pc-input">
                    <button type="submit" class="btn btn-secondary" id="pc-button">Сохранить</button>
                </div>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Контактная информация</h4>
                <form action="{{ route('basket.doCheckout') }}" method="post" class="needs-validation {{ $errors->any() ? 'was-validated' : '' }}" novalidate>
                    @csrf
                    @method('POST')

                    <input type="hidden" id="pc-form-value" name="promocode" value="" />

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Имя</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Денис" value="{{ old('name') ?? $basket->name ?? \Illuminate\Support\Facades\Auth::user()->name ?? '' }}" required>
                            <div class="invalid-feedback">
                                Введите корректное имя
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="surname" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Петров" value="{{ old('surname') ?? $basket->surname ?? \Illuminate\Support\Facades\Auth::user()->surname ?? '' }}" required>
                            <div class="invalid-feedback">
                                Введите корректную фамилию
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label">Номер телефона <span class="text-muted">(только российские номера)</span></label>
                            <div class="input-group">
                                <span class="input-group-text">7</span>
                                <input type="tel" class="form-control" name="phone" id="phone" pattern="[0-9]{10}" placeholder="9991234567" value="{{ old('phone') ?? $basket->phone ?? \Illuminate\Support\Facades\Auth::user()->phone ?? '' }}">
                            </div>
                            <div class="invalid-feedback">
                                Введите корректный номер телефона
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="saveData" name="saveData" value="1">
                        <label class="form-check-label" for="saveData">Сохранить данные для следующих заказов</label>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Отправить заказ</button>
                </form>
            </div>
        </div>
    </div>

    <script defer>
        const hideLoaded = () => $('#pc-li-loaded').attr('style', 'display: none !important');
        const showLoaded = () => $('#pc-li-loaded').show();

        const hideLoadedError = () => $('#pc-li-loaded-error').attr('style', 'display: none !important');
        const showLoadedError = () => $('#pc-li-loaded-error').show();

        const hideLoading = () => $('#pc-li-loading').hide();
        const showLoading = () => $('#pc-li-loading').show();

        const startTotalCost = {{ $total_cost }};

        const changeTotalCost = (newCost = null) => {
            if(newCost === null) {
                $('#totalCostText').html(startTotalCost.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB' }));
            } else {
                $('#totalCostText').html(newCost.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB' }));
            }
        };

        const changePCInputVal = (promocode = null) => {
            if(promocode === null) {
                $('#pc-form-value').val('');
            } else {
                $('#pc-form-value').val(promocode);
            }
        };

        function checkPromocode(promocode) {
            $.ajax({
                url: '/basket/check/' + promocode,
                type: 'GET',
                success: function(response) {
                    // Обновляем информацию о скидке на странице
                    console.log(response.ok)
                    if (response.ok) {
                        $('#pc-li-amount').html('-' + response.discount.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB' }));
                        $('#pc-li-pc').html(promocode);

                        changePCInputVal(promocode);

                        showLoaded();
                        hideLoading();

                        changeTotalCost(startTotalCost - response.discount);
                    } else {
                        hideLoading();

                        $('#pc-error-text').html(response.reason);

                        changePCInputVal();
                        changeTotalCost();

                        showLoadedError();
                    }
                },
                error: function(response) {
                    hideLoading();

                    $('#pc-error-text').html('Проверьте соединение с интернетом');

                    changePCInputVal();
                    changeTotalCost();

                    showLoadedError();
                }
            });
        }

        $('#pc-button').click(function() {
            hideLoaded();
            hideLoadedError();
            showLoading();

            var promocode = $('#pc-input').val();
            checkPromocode(promocode);
        });
    </script>
@endsection
