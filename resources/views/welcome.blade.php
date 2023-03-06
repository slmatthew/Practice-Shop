@extends('app')

@section('content')
    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">slm.shop</h1>
                    <p class="lead text-muted">Продавцы говна. Говно на любой вкус - твердое, жидкое, с подливкой и без. Каждый найдет подходящее.</p>
                    <p>
                        <a href="#" class="btn btn-primary my-2">Зарегистрироваться</a>
                        <a href="#" class="btn btn-secondary my-2">Войти</a>
                    </p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @include('card')
                </div>
            </div>
        </div>

    </main>
@endsection
