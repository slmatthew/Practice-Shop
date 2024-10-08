@extends('layouts.admin-master', ['navbar' => 'products', 'pageTitle' => 'Редактирование'])

@section('header')
    @if($nextPrev['next'] || $nextPrev['prev'])
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <div class="dropdown mb-3">
                    @if($nextPrev['prev'])
                        <a href="{{ route('admin.product', $nextPrev['prev']) }}" role="button" class="btn btn-outline-secondary btn-sm">Назад</a>
                    @endif
                    @if($nextPrev['next'])
                        <a href="{{ route('admin.product', $nextPrev['next']) }}" role="button" class="btn btn-outline-secondary btn-sm">Вперед</a>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($success))
        <div class="alert alert-{{ $success ? 'success' : 'danger' }}" role="alert">
            Товар {{ $success ? 'был' : 'не был' }} успешно обновлен
        </div>
    @endif

    <form method="post" action="{{ route('admin.product.update', $product['id']) }}" enctype="multipart/form-data">

        @csrf

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pId">Номер</label>
            <div class="col-sm-10">
                <input name="id" type="number" class="form-control-plaintext" value="{{ $product['id'] }}" id="pId" required readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pName">Название</label>
            <div class="col-sm-10">
                <input name="name" type="text" class="form-control" placeholder="Смартфон" value="{{ $product['name'] }}" id="pName" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pSlug">ЧПУ</label>
            <div class="col-sm-10">
                <input name="slug" type="text" class="form-control" placeholder="smartphone" value="{{ $product['slug'] }}" id="pSlug" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pDesc">Описание</label>
            <div class="col-sm-10">
                <textarea name="description" style="resize: none" class="form-control" placeholder="Крутой смартфон" rows="3" id="pDesc">{{ $product['description'] }}</textarea>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pDescCounter">Символов в описании (идеал до 160):</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ mb_strlen($product['description']) }}" id="pDescCounter" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pPrice">Стоимость</label>
            <div class="col-sm-10">
                <input name="price" type="number" class="form-control" value="{{ $product['price'] }}" id="pPrice" step=".01" required>
                @if($product->hasDiscount())
                    <p class="text-danger">
                        Не забудьте удалить скидки!
                    </p>
                @endif
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pImage">Адрес картинки</label>
            <div class="col-sm-10">
                <input name="image" type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="pImage">
                <br />
                <img src="{{ $product['image_url'] }}" style="max-width: 20em;max-height: 20em" class="img-thumbnail rounded float-start" alt="...">
            </div>
        </div>

        @if(mb_strlen($product['image_url']) > 0 && str_starts_with($product['image_url'], env('APP_URL', 'https://shop.slmatthew.ru').'/storage/'))
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label form-check-label" for="pDeleteImage">
                    Удалить загруженное изображение
                </label>
                <div class="col-sm-10">
                    <input name="delete_image" class="form-check-input" type="checkbox" value="1" id="pDeleteImage">
                </div>
            </div>
        @endif

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pCategory">Категория</label>
            <div class="col-sm-10">
                <select name="category_id" class="form-select" aria-label="Default select example" id="pCategory">
                    <option value="" {{ !is_null($product['category_id']) ?: 'selected' }}>Не выбрано</option>
                    @foreach($categories as $ctg)
                        <option value="{{ $ctg['id'] }}" {{ $product['category_id'] != $ctg['id'] ?: 'selected' }}>{{ $ctg['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pBrand">Бренд</label>
            <div class="col-sm-10">
                <select name="brand_id" class="form-select" aria-label="Default select example" id="pBrand">
                    <option value="0" {{ is_null($product['brand_id']) ? 'selected' : '' }}>Нет значения</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $product['brand_id'] ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label form-check-label" for="pHidden">
                Скрыть
            </label>
            <div class="col-sm-10">
                <input name="hidden" class="form-check-input" type="checkbox" value="1" id="pHidden" {{ $product['hidden'] ? 'checked' : '' }}>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label form-check-label" for="pAvailable">
                Есть в наличии
            </label>
            <div class="col-sm-10">
                <input name="available" class="form-check-input" type="checkbox" value="1" id="pAvailable" {{ $product['available'] ? 'checked' : '' }}>
            </div>
        </div>

        <hr class="my-4" />

        @php($discounts = $product->discounts()->orderBy('id', 'desc')->limit(3)->get())

        @if($discounts->count())
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Скидки</label>
                <div class="col-sm-4">
                    <ul class="list-group">
                        @foreach($discounts as $discount)

                            @php($dlActive = $product->discounts()->latest()->get()[0]->id == $discount->id)
                            @php($dlActual = !is_null($discount->end_date) && \Carbon\Carbon::parse($discount->end_date, 'Europe/Moscow')->gt(\Carbon\Carbon::now('Europe/Moscow')))

                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">
                                        {{ $discount->isFixed() ? 'Фиксированная' : 'Процентная' }} скидка
                                    </div>

                                    Новая цена: {{ $product->formatPrice($product->getDiscountedPrice($discount)) }} ({{ $product->getDiscountPercent($discount) }}%)
                                </div>

                                @if($dlActual || (is_null($discount->end_date) && $dlActive))
                                    <span class="badge text-bg-primary rounded-pill me-1">
                                        активна
                                    </span>
                                @endif

                                <span class="badge text-bg-{{ $dlActual ? 'danger' : 'secondary' }} rounded-pill">
                                    @if(!is_null($discount->end_date))
                                        до {{ \Carbon\Carbon::parse($discount->end_date, 'Europe/Moscow')->format('d.m.Y') }}
                                    @else
                                        бессрочно
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="mb-3 row">
            <div class="col-sm-2">{{ $discounts->count() ? '' : 'Скидки' }}</div>
            <div class="col-sm-10">
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="{{ "#m-ad-{$product['id']}" }}">Добавить</button>
                @if($discounts->count())
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="{{ "#m-cd-{$product['id']}" }}">Очистить</button>
                @endif
            </div>
        </div>

        <hr class="my-4" />

        <div class="d-grid gap-2">
            <button class="w-100 btn btn-lg btn-outline-primary" type="submit">Сохранить</button>
            <a href="{{ route('admin.products.main') }}" role="link" class="w-100 btn btn-lg btn-outline-danger" type="submit">Отменить</a>
        </div>

    </form>

    <script>
        document.getElementById('pDesc').onkeyup = function () {
            document.getElementById('pDescCounter').value = this.value.length;
        };
    </script>

    @include('admin.products.partials.addDiscount', ['product' => $product])
    @include('admin.products.partials.clearDiscount', ['product' => $product])
@endsection
