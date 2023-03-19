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

    <form method="post" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">

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

        @if(mb_strlen($product['image_url']) > 0 && str_starts_with($product['image_url'], '/storage/'))
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
@endsection
