@extends('app', ['navbar' => 'product'])

@section('content')
    <main>

        {{ $product->name ?? null }}

    </main>
@endsection
