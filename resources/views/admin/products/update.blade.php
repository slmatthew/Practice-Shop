@extends('layouts.admin-master', ['navbar' => 'products'])

@section('content')
    <form method="post" action="{{ route('admin.product.update', $product['id']) }}">

    </form>
@endsection
