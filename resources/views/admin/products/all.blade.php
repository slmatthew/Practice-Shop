@extends('layouts.admin-master', ['navbar' => 'products', 'pageTitle' => 'Товары'])

@section('header')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <div class="dropdown mb-3">
                <a href="{{ route('admin.product.add') }}" role="button" class="btn btn-outline-primary btn-sm">Добавить</a>
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Сортировка
                    @if(Request::has('sort'))
                        @switch(Request::get('sort'))
                            @case('name')
                                по названию {{ Request::get('direction') == 'asc' ? 'возр' : 'убыв' }}
                                @break
                            @case('price')
                                по цене {{ Request::get('direction') == 'asc' ? 'возр' : 'убыв' }}
                                @break
                            @case('created_at')
                                по новизне {{ Request::get('direction') == 'asc' ? 'возр' : 'убыв' }}
                                @break

                            @default
                                @break
                        @endswitch
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li>@sortablelink('name', 'По названию', [], ['class' => 'dropdown-item'])</li>
                    <li>@sortablelink('price', 'По цене', [], ['class' => 'dropdown-item'])</li>
                    <li>@sortablelink('created_at', 'По новизне', [], ['class' => 'dropdown-item'])</li>
                    @if(Request::has('sort'))
                        <li><a href="?" class="dropdown-item">Cбросить</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')

    @if(!empty($deleteResult))
        <div class="alert alert-{{ $deleteResult[0] ? 'success' : 'danger' }}" role="alert">
            Товар #{{ $deleteResult[1] }} ({{ $deleteResult[2] }}) {{ $deleteResult[0] ? '' : 'не' }} был удален
        </div>
    @endif

    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Категория</th>
            <th scope="col">Скрыт / в наличии</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">
                    <img src="{{ $product->image_url }}" style="max-width: 5em;max-height: 5em" class="img-thumbnail rounded float-start">
                </th>
                <td>{{ $product->name }}</td>
                <td>
                    @if($product->category[0])
                        {{ $product->category[1]->name }}
                    @else
                        нет
                    @endif
                </td>
                <td>{{ $product->hidden ? 'да' : 'нет' }} / {{ $product->available ? 'да' : 'нет' }}</td>
                <td>
                    <a href="{{ route('products.item', $product->id) }}" target="_blank" role="button" class="btn btn-outline-secondary btn-sm">Открыть</a>
                    <a href="{{ route('admin.product', $product->id) }}" role="button" class="btn btn-outline-primary btn-sm">Изменить</a>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ "mdpc{$product->id}" }}">
                        Удалить
                    </button>
                    {{--                        <a href="{{ route('admin.product.delete', $product['id']) }}" role="button" class="btn btn-outline-danger btn-sm">Удалить</a>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $products->appends(Request::except('page'))->render() !!}

    @foreach($products as $product)
        @include('admin.partials.modalDelete', ['action' => route('admin.product.delete'), 'id' => $product->id, 'product' => $product->toArray()])
    @endforeach
@endsection
