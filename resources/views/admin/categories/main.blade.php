@extends('layouts.admin-master', ['navbar' => 'categories', 'pageTitle' => 'Категории'])

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

    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Обложка</th>
            <th scope="col"></th>
            <th scope="col">Название</th>
            <th scope="col">ЧПУ</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $ctg)
            <tr>
                @if($ctg->id == 0)
                    <th scope="row">
                        {{ $ctg->id }}
                    </th>
                    <td></td>
                    <td></td>
                    <td>{{ $ctg->name }}</td>
                    <td>
                        {{ $ctg->slug }}
                    </td>
                    <td>
                        <a href="{{ route('products.byCategory', $ctg) }}" target="_blank" role="button" class="btn btn-outline-secondary btn-sm">Открыть</a>
                    </td>
                @else
                    <form method="post" action="{{ route('admin.category.update') }}" enctype="multipart/form-data" class="d-inline-block">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="{{ $ctg->id }}" />

                        <th scope="row">
                            {{ $ctg->id }}
                        </th>
                        <td>
                            <img src="{{ $ctg->image_url }}" style="max-width: 5em;max-height: 5em" class="img-thumbnail rounded float-start">
                        </td>
                        <td class="col-sm">
                            <input name="image" type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="pImage">
                        </td>
                        <td>
                            <input name="name" type="text" class="form-control" placeholder="Смартфоны" value="{{ $ctg->name }}" id="pName" required>
                        </td>
                        <td>
                            <input name="slug" type="text" class="form-control" placeholder="smartphones" value="{{ $ctg->slug ?? '' }}" id="pSlug" required>
                        </td>
                        <td>
                            <a href="{{ route('products.byCategory', $ctg) }}" target="_blank" role="button" class="btn btn-outline-secondary btn-sm">Открыть</a>
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                Сохранить
                            </button>
                    </form>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "mdpc{$ctg->id}" }}">
                                Удалить
                            </button>
                        </td>
                @endif
            </tr>
        @endforeach
            <tr>
                <form method="post" action="{{ route('admin.category.add') }}" enctype="multipart/form-data" class="d-inline-block">
                    @csrf
                    @method('POST')

                    <th scope="row"></th>
                    <td></td>
                    <td class="col-sm">
                        <input name="image" type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="pImage">
                    </td>
                    <td>
                        <input name="name" type="text" class="form-control" placeholder="Смартфоны" value="" id="pName" required>
                    </td>
                    <td>
                        <input name="slug" type="text" class="form-control" placeholder="smartphones" value="" id="pSlug" required>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            Сохранить
                        </button>
                </form>
                    </td>
            </tr>
        </tbody>
    </table>

    {!! $categories->appends(Request::except('page'))->render() !!}

    @foreach($categories as $ctg)
        @if($ctg->id != 0)
            @include('admin.partials.modalDelete', ['action' => route('admin.category.delete'), 'id' => $ctg['id'], 'category' => $ctg])
        @endif
    @endforeach
@endsection
