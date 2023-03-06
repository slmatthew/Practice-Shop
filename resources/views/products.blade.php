@extends('layouts.app')

@section('content')
    <main>

        @foreach($products as $product)
            <h1>{{ $product->name }}</h1>
        @endforeach

    </main>
@endsection
