<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} · Управление</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link type="image/png" rel="icon" href="{{ asset('favicon/1080x1080.png') }}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('main') }}">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
{{--    <div class="navbar-nav">--}}
{{--        <div class="nav-item text-nowrap">--}}
{{--            <a class="nav-link px-3" href="#">Sign out</a>--}}
{{--        </div>--}}
{{--    </div>--}}
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column">
                    @foreach([
                        [
                            'navItem' => 'home',
                            'route' => 'admin.home',
                            'feather' => 'home',
                            'text' => 'Управление'
                        ],
                        [
                            'navItem' => 'products',
                            'route' => 'admin.products.main',
                            'feather' => 'layers',
                            'text' => 'Товары'
                        ],
                        [
                            'navItem' => 'categories',
                            'route' => 'admin.categories.main',
                            'feather' => 'folder',
                            'text' => 'Категории'
                        ],
                        [
                            'navItem' => 'brands',
                            'route' => 'admin.brands.main',
                            'feather' => 'server',
                            'text' => 'Бренды'
                        ],
                        [
                            'navItem' => 'orders',
                            'route' => 'admin.orders.main',
                            'feather' => 'file',
                            'text' => 'Заказы'
                        ],
                        [
                            'navItem' => 'promocodes',
                            'route' => 'admin.promocodes.main',
                            'feather' => 'gift',
                            'text' => 'Промокоды'
                        ],
                        [
                            'navItem' => 'users',
                            'route' => 'admin.users.main',
                            'feather' => 'users',
                            'text' => 'Пользователи'
                        ]
                    ] as $navItem)
                        <li class="nav-item">
                            <a class="nav-link {{ $navbar == $navItem['navItem'] ? 'active' : '' }}" aria-current="page" href="{{ route($navItem['route']) }}">
                                <span data-feather="{{ $navItem['feather'] }}" class="align-text-bottom"></span>
                                {{ $navItem['text'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ $pageTitle }}</h1>
                @yield('header')
            </div>

            @yield('content')
        </main>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="{{ asset('js/admin.js') }}"></script>

</body>
</html>
