@extends('layouts.admin-master', ['navbar' => 'home', 'pageTitle' => 'Управление'])

@section('content')
    <style>
        .card-link-custom {
            color: inherit;
            text-decoration: none;
        }

        .card-link-custom:hover .card {
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
            border-color: var(--bs-secondary-color);
        }
    </style>

    <div class="col-md-10">
        <div class="row mb-3">
            <div class="col-xl-3 col-lg-6">
                <a href="{{ route('admin.users.main') }}" class="card-link-custom">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Пользователи</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        {{ number_format($users, 0, '', ' ') }}
                                    </h2>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6">
                <a href="{{ route('admin.products.main') }}" class="card-link-custom">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Товары</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        {{ number_format($products[0], 0, '', ' ') }}
                                    </h2>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar bg-danger" role="progressbar" data-width="{{ $products[1] }}%" aria-valuenow="{{ $products[1] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $products[1] }}%;"></div>
                                <div class="progress-bar bg-warning" role="progressbar" data-width="{{ $products[2] }}%" aria-valuenow="{{ $products[2] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $products[2] }}%;"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6">
                <a href="{{ route('admin.orders.main') }}" class="card-link-custom">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            {{--                        <div class="card-icon card-icon-large">123</div>--}}
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Заказы</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        {{ number_format($orders[0], 0, '', ' ') }}
                                    </h2>
                                </div>
                                {{--                            <div class="col-4 text-right">--}}
                                {{--                                <span>12.5%</span>--}}
                                {{--                            </div>--}}
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" data-width="{{ $orders[1] }}%" aria-valuenow="{{ $orders[1] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $orders[1] }}%;"></div>
                                <div class="progress-bar bg-success" role="progressbar" data-width="{{ $orders[2] }}%" aria-valuenow="{{ $orders[2] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $orders[2] }}%;"></div>
                                <div class="progress-bar bg-light" role="progressbar" data-width="{{ $orders[3] }}%" aria-valuenow="{{ $orders[3] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $orders[3] }}%;"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <p>
                Режим:
                <span class="badge text-bg-{{ env('APP_ENV', 'production') == 'production' ? 'primary' : 'dark' }}">{{ env('APP_ENV', 'production') }}</span>
            </p>
            <p>
                Дебаг:
                <span class="badge text-bg-{{ (bool) env('APP_DEBUG', false) ? 'danger' : 'secondary' }}">{{ (bool) env('APP_DEBUG', false) ? 'да' : 'нет' }}</span>
            </p>
            <p>
                URL: {{ env('APP_URL', 'default') }}
            </p>
        </div>
    </div>

    <h2>База данных</h2>

    <div class="col-md-10">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <p>
                    Имя БД: {{ env('DB_DATABASE') }}
                </p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-3 col-lg-6">
                <a href="{{ route('admin.orders.clear') }}" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Очистить orders и orders_items">
                    Удалить все заказы
                </a>
            </div>
        </div>
    </div>

    <script defer>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
