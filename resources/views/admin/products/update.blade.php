@extends('layouts.admin-master', ['navbar' => 'products', 'pageTitle' => 'Редактирование'])

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
                    <option value="0" {{ !is_null($product['category_id']) ?: 'selected' }}>Не выбрано</option>
                    @foreach($categories as $ctg)
                        <option value="{{ $ctg['id'] }}" {{ $product['category_id'] != $ctg['id'] ?: 'selected' }}>{{ $ctg['name'] }}</option>
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
            <a href="{{ route('admin.products') }}" role="link" class="w-100 btn btn-lg btn-outline-danger" type="submit">Отменить</a>
        </div>

    </form>
@endsection
