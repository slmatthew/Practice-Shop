@extends('app', ['navbar' => 'basket'])

@section('content')
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
                    $total_cost += $item['product']->getPrice() * $item['quantity'];
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
{{--                    <li class="list-group-item d-flex justify-content-between bg-light">--}}
{{--                        <div class="text-success">--}}
{{--                            <h6 class="my-0">Promo code</h6>--}}
{{--                            <small>EXAMPLECODE</small>--}}
{{--                        </div>--}}
{{--                        <span class="text-success">−$5</span>--}}
{{--                    </li>--}}
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Всего</span>
                        <strong>{{ App\Models\Product::formatPrice($total_cost) }}</strong>
                    </li>
                </ul>

{{--                <form class="card p-2">--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" class="form-control" placeholder="Promo code">--}}
{{--                        <button type="submit" class="btn btn-secondary">Redeem</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Контактная информация</h4>
                <form action="{{ route('basket.doCheckout') }}" method="post" class="needs-validation {{ $errors->any() ? 'was-validated' : '' }}" novalidate>
                    @csrf
                    @method('POST')

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
@endsection
