@extends('app', ['navbar' => 'main', 'css' => ['welcome.css']])

@section('content')
    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">slm.shop</h1>
                    <p class="lead text-muted">Современный магазин электроники и компьютерной периферии</p>
                    @auth
                        <p>
                            <a href="{{ route('products.categories') }}" role="button" class="btn btn-outline-primary my-2">Перейти в каталог</a>
                        </p>
                    @endauth
                </div>
            </div>
        </section>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="box" viewBox="0 0 16 16">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
            </symbol>
            <symbol id="chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
            </symbol>
            <symbol id="cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
            <symbol id="telephone" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
            </symbol>
        </svg>

        <div class="bg-light p-5 container rounded" id="featured">
{{--            <h2 class="pb-2 border-bottom">Преимущества</h2>--}}
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#box"/></svg>
                    </div>
                    <h3 class="fs-2">Быстрая доставка</h3>
                    <p>Мы сотрудничаем со многими сервисами доставки, благодаря чему Вы можете получить товар в день заказа</p>
{{--                    <a href="#" class="icon-link d-inline-flex align-items-center">--}}
{{--                        Подробнее--}}
{{--                        <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>--}}
{{--                    </a>--}}
                </div>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#cart"/></svg>
                    </div>
                    <h3 class="fs-2">Удобная корзина</h3>
                    <p>Проработанный интерфейс интернет-магазина позволит ощутить предвкушение покупки новой техники</p>
{{--                    <a href="#" class="icon-link d-inline-flex align-items-center">--}}
{{--                        Подробнее--}}
{{--                        <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>--}}
{{--                    </a>--}}
                </div>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#telephone"/></svg>
                    </div>
                    <h3 class="fs-2">Всегда на связи</h3>
                    <p>Личный менеджер ответит Вам в любое время и ответит на возникшие вопросы</p>
{{--                    <a href="#" class="icon-link d-inline-flex align-items-center">--}}
{{--                        Подробнее--}}
{{--                        <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>

        @guest
            <div class="px-4 py-5 my-5 text-center">
                <h1 class="display-5 fw-bold">Остался один шаг...</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">От приятных покупок Вас отделяет всего лишь простая регистрация! Несколько кликов — и Вы в slm.shop</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a role="button" href="{{ route('register.perform') }}" class="btn btn-primary btn-lg px-4 gap-3">Зарегистрироваться</a>
                        <a role="button" href="{{ route('login.perform') }}" class="btn btn-outline-secondary btn-lg px-4">Войти</a>
                    </div>
                </div>
            </div>
        @endguest

    </main>
@endsection
