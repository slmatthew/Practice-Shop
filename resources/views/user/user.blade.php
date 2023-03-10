@extends('app', ['navbar' => ''])

@section('content')
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="{{ $user['image'] }}"
                                     alt="{{ "@{$user['username']}" }} image" class="img-fluid img-thumbnail mt-4 mb-2"
                                     style="width: 150px; z-index: 1">
                                @if(Auth::check() && auth()->user()->toArray()['id'] == $user['id'])
                                    <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                            style="z-index: 1;">
                                        Редактировать
                                    </button>
                                @endif
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>{{ "{$user['name']}  {$user['surname']}" }}</h5>
                                <p>{{ "@{$user['username']}" }}</p>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <div>
                                    <p class="mb-1 h5">0</p>
                                    <p class="small text-muted mb-0">заказов</p>
                                </div>
                            </div>
                        </div>
{{--                        <div class="card-body p-4 text-black">--}}
{{--                            <div>--}}
{{--                                <p class="lead fw-normal mb-1">About</p>--}}
{{--                                <div class="p-4" style="background-color: #f8f9fa;">--}}
{{--                                    <p class="font-italic mb-1">Web Developer</p>--}}
{{--                                    <p class="font-italic mb-1">Lives in New York</p>--}}
{{--                                    <p class="font-italic mb-0">Photographer</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
