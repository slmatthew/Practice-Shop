<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if(isset($css))
        @foreach($css as $cssfile)
            <link href="{{ asset("css/{$cssfile}") }}" rel="stylesheet">
        @endforeach
    @endif

    <link type="image/png" rel="icon" href="{{ asset('favicon/1080x1080.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <svg id="slmshop" viewBox="0 0 36 36">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.6479999999999999"></g>
        <g id="SVGRepo_iconCarrier">
            <path fill="#000000" d="M36 32a4 4 0 0 1-4 4H4a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4h28a4 4 0 0 1 4 4v28z"></path>
            <path fill="#ffffff" d="M24.125 9.652c0 1.209-.806 2.294-2.076 2.294c-1.271 0-2.264-.93-4.125-.93c-1.333 0-2.542.713-2.542 2.016c0 3.193 10.357 1.147 10.357 9.146c0 4.434-3.659 7.193-7.938 7.193c-2.388 0-7.534-.558-7.534-3.473c0-1.209.806-2.201 2.077-2.201c1.457 0 3.193 1.209 5.209 1.209c2.046 0 3.163-1.147 3.163-2.667c0-3.658-10.356-1.457-10.356-8.65c0-4.341 3.565-7.038 7.689-7.038c1.736.001 6.076.652 6.076 3.101z"></path>
        </g>
    </svg>
    <symbol id="redHeart" viewBox="0 0 24 24">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
            <path d="M16.1315 3.71436C14.4172 3.71436 12.9029 4.57721 12 5.8915C11.0972 4.57721 9.58289 3.71436 7.86861 3.71436C5.10289 3.71436 2.85718 5.96007 2.85718 8.72578C2.85718 14.8344 12 20.3258 12 20.3258C12 20.3258 21.1429 14.8344 21.1429 8.72578C21.1429 5.96007 18.8972 3.71436 16.1315 3.71436Z" fill="url(#paint0_radial)"></path>
            <path opacity="0.5" d="M18.2056 4.16016C20.9485 8.53158 18.4228 14.2687 15.3885 15.8973C12.0399 17.6973 9.74847 16.8516 5.00562 14.1602C7.70847 17.743 11.9999 20.3202 11.9999 20.3202C11.9999 20.3202 21.1428 14.8287 21.1428 8.72016C21.1428 6.6973 19.937 4.94873 18.2056 4.16016Z" fill="url(#paint1_radial)"></path>
            <path opacity="0.5" d="M16.1315 3.71436C14.4172 3.71436 12.9029 4.57721 12 5.8915C11.0972 4.57721 9.58289 3.71436 7.86861 3.71436C5.10289 3.71436 2.85718 5.96007 2.85718 8.72578C2.85718 14.8344 12 20.3258 12 20.3258C12 20.3258 21.1429 14.8344 21.1429 8.72578C21.1429 5.96007 18.8972 3.71436 16.1315 3.71436Z" fill="url(#paint2_radial)"></path>
            <path opacity="0.5" d="M16.1315 3.71436C14.4172 3.71436 12.9029 4.57721 12 5.8915C11.0972 4.57721 9.58289 3.71436 7.86861 3.71436C5.10289 3.71436 2.85718 5.96007 2.85718 8.72578C2.85718 14.8344 12 20.3258 12 20.3258C12 20.3258 21.1429 14.8344 21.1429 8.72578C21.1429 5.96007 18.8972 3.71436 16.1315 3.71436Z" fill="url(#paint3_radial)"></path>
            <path opacity="0.24" d="M10.7486 5.74883C11.2514 6.93169 10.1371 8.5374 8.25714 9.33169C6.37714 10.126 4.45143 9.8174 3.94857 8.64026C3.44571 7.46312 4.56 5.85169 6.44 5.0574C8.32 4.26312 10.2457 4.56597 10.7486 5.74883Z" fill="url(#paint4_radial)"></path>
            <path opacity="0.24" d="M16.8742 4.78885C17.5885 5.57742 17.1485 7.13742 15.8971 8.26885C14.6456 9.40028 13.0513 9.68028 12.3371 8.8917C11.6228 8.10313 12.0628 6.54313 13.3142 5.41171C14.5656 4.28028 16.1599 4.00028 16.8742 4.78885Z" fill="url(#paint5_radial)"></path>
            <path opacity="0.32" d="M16.2229 5.04578C18.7372 5.90293 21.1372 9.61721 17.0801 14.2458C14.6515 17.0172 12.0001 18.4172 8.62866 17.8686C10.4515 19.3886 12.0058 20.3258 12.0058 20.3258C12.0058 20.3258 21.1487 14.8344 21.1487 8.72578C21.1429 5.96007 18.8972 3.71436 16.1315 3.71436C14.4172 3.71436 12.9029 4.57721 12.0001 5.8915C12.0001 5.8915 14.3829 4.41721 16.2229 5.04578Z" fill="url(#paint6_linear)"></path>
            <defs>
                <radialGradient id="paint0_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(9.38479 8.34769) rotate(-29.408) scale(14.3064 11.3486)">
                    <stop offset="0.2479" stop-color="#FF0000"></stop>
                    <stop offset="0.8639" stop-color="#FF0000"></stop>
                </radialGradient>
                <radialGradient id="paint1_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(9.7385 7.47018) rotate(-29.408) scale(12.3173 9.77078)">
                    <stop offset="0.2479" stop-color="#FF0000"></stop>
                    <stop offset="1" stop-color="#FF0000"></stop>
                </radialGradient>
                <radialGradient id="paint2_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(9.38479 8.34769) rotate(-29.408) scale(14.3064 11.3486)">
                    <stop stop-color="white" stop-opacity="0.25"></stop>
                    <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                </radialGradient>
                <radialGradient id="paint3_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(14.5277 13.2044) rotate(-26.296) scale(10.4431 5.16038)">
                    <stop stop-color="#FF0000" stop-opacity="0.25"></stop>
                    <stop offset="1" stop-color="#FF0000" stop-opacity="0"></stop>
                </radialGradient>
                <radialGradient id="paint4_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(7.34746 7.19453) rotate(-21.6908) scale(3.71252 2.30616)">
                    <stop stop-color="white"></stop>
                    <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                </radialGradient>
                <radialGradient id="paint5_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(14.6004 6.84619) rotate(-40.7634) scale(3.07376 1.9095)">
                    <stop stop-color="white"></stop>
                    <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                </radialGradient>
                <linearGradient id="paint6_linear" x1="13.8868" y1="26.8498" x2="15.6583" y2="2.96408" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FF0000"></stop>
                    <stop offset="1" stop-color="#FF0000" stop-opacity="0"></stop>
                </linearGradient>
            </defs>
        </g>
    </symbol>
    <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
    </symbol>
    <symbol id="speedometer2" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
    </symbol>
    <symbol id="table" viewBox="0 0 16 16">
        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
    </symbol>
    <symbol id="grid" viewBox="0 0 16 16">
        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
    </symbol>
</svg>
<header class="p-3 mb-3 border-bottom sticky-top navbar-light bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('main') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <svg class="bi me-2" width="32" height="32" role="img" aria-label="slm.shop"><use xlink:href="#slmshop"/></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('main') }}" class="nav-link px-2 link-{{ $navbar == 'main' ? 'secondary' : 'dark' }}">Главная</a></li>
                <li><a href="{{ route('products.categories') }}" class="nav-link px-2 link-{{ $navbar == 'products' ? 'secondary' : 'dark' }}">Товары</a></li>
                <li><a href="{{ route('basket.index') }}" class="nav-link px-2 link-{{ $navbar == 'basket' ? 'secondary' : 'dark' }}">Корзина</a></li>
                <li><a href="{{ route('about') }}" class="nav-link px-2 link-{{ $navbar == 'about' ? 'secondary' : 'dark' }}">О нас</a></li>
            </ul>

{{--            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">--}}
{{--                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">--}}
{{--            </form>--}}

            @auth
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->image }}" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="{{ route('user.me') }}">{{ auth()->user()->username }}</a></li>
                        @if(auth()->user()->isAdmin())
                            <li><a class="dropdown-item" href="{{ route('admin.home') }}">Управление</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="{{ route('logout.perform') }}" class="dropdown-item">Выйти</a></li>
                    </ul>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-secondary my-2">Вход</a>
                    <a href="{{ route('register.perform') }}" class="btn btn-outline-primary my-2">Регистрация</a>
                </div>
            @endguest
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="text-muted py-5">
    <div class="container">
{{--        <p class="float-end mb-1">--}}
{{--            <a href="#">Вернуться в начало</a>--}}
{{--        </p>--}}
        <p class="mb-1">&copy; slmatthew, 2023 <svg class="bi me-2" width="20" height="20" role="img" aria-label="heart"><use xlink:href="#redHeart"/></svg></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
