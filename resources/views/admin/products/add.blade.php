@extends('layouts.admin-master', ['navbar' => 'products', 'pageTitle' => 'Новый товар'])

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

    <form method="post" action="{{ route('admin.product.add.action') }}" enctype="multipart/form-data">

        @csrf

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pName">Название</label>
            <div class="col-sm-10">
                <input name="name" type="text" class="form-control" placeholder="Смартфон" value="{{ old('name') }}" id="pName" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pDesc">Описание</label>
            <div class="col-sm-10">
                <textarea name="description" style="resize: none" class="form-control" placeholder="Крутой смартфон" rows="3" id="pDesc">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pDescCounter">Символов в описании (идеал до 160):</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" value="{{ old('description') ? mb_strlen(old('description')) : 0 }}" id="pDescCounter" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pPrice">Стоимость</label>
            <div class="col-sm-10">
                <input name="price" type="number" class="form-control" placeholder="999,00" value="{{ old('price') }}" id="pPrice" step=".01" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pImage">Изображение</label>
            <div class="col-sm-10">
                <input name="image" type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="pImage">
{{--                    <br />--}}
{{--                    <img src="{{ $product['image_url'] }}" style="max-width: 20em;max-height: 20em" class="img-thumbnail rounded float-start" alt="...">--}}
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label" for="pCategory">Категория</label>
            <div class="col-sm-10">
                <select name="category_id" class="form-select" aria-label="Default select example" id="pCategory">
                    @foreach($categories as $ctg)
                        <option value="{{ $ctg['id'] }}" {{ old('category_id') == $ctg['id'] ? 'selected' : '' }}>{{ $ctg['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label form-check-label" for="pHidden">
                Скрыть
            </label>
            <div class="col-sm-10">
                <input name="hidden" class="form-check-input" type="checkbox" value="1" id="pHidden">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label form-check-label" for="pAvailable">
                Есть в наличии
            </label>
            <div class="col-sm-10">
                <input name="available" class="form-check-input" type="checkbox" value="1" id="pAvailable" checked>
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
