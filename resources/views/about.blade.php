@extends('app', ['navbar' => 'about'])

@section('content')
    <div class="container pt-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Наша история</h1>
                <p class="col-md-8 fs-4">Узнайте больше о нашей компании и ее истории. Мы гордимся своим опытом и стремимся предоставить нашим клиентам только самые лучшие продукты и услуги</p>
                <button class="btn btn-primary btn-lg" type="button">Читать</button>
            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Наша команда</h2>
                    <p>Наши сотрудники - это наша главная сила. Мы заботимся о том, чтобы каждый член нашей команды был талантливым, профессиональным и увлеченным</p>
                    <button class="btn btn-outline-light" type="button">Читать</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Наши ценности</h2>
                    <p>Мы стремимся быть лучшими во всем, что делаем. Наши ценности - это качество, инновации и превосходство в обслуживании клиентов</p>
                    <button class="btn btn-outline-secondary" type="button">Читать</button>
                </div>
            </div>
        </div>
    </div>
@endsection
