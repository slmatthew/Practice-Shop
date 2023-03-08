@extends('layouts.admin-master', ['navbar' => 'products'])

@section('content')
    <div class="container">
        <form method="post" action="{{ route('admin.product.update') }}">

            @csrf

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pId">Номер</label>
                <div class="col-sm-10">
                    <input name="id" type="number" class="form-control-plaintext" value="{{ $product['id'] }}" id="pId" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pName">Название</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="Смартфон" value="{{ $product['name'] }}" id="pName">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pDesc">Описание</label>
                <div class="col-sm-10">
                    <textarea name="description" style="resize: none" class="form-control" placeholder="Крутой смартфон" rows="3" id="pDesc">{{ $product['description'] }}</textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pPrice">Цена</label>
                <div class="col-sm-10">
                    <input name="price" type="number" class="form-control" value="{{ $product['price'] }}" id="pPrice" step=".01">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pImage">Адрес картинки</label>
                <div class="col-sm-10">
                    <input name="image_url" type="text" class="form-control" value="{{ $product['image_url'] }}" id="pImage">
                    <br />
                    <img src="{{ $product['image_url'] }}" style="max-width: 20em;max-height: 20em" class="img-thumbnail rounded float-start" alt="...">
                </div>
            </div>

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
    </div>
@endsection
