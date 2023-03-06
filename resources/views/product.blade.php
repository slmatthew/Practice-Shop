@extends('layouts.app')

@section('content')
    <main>

        {{ $product->name ?? null }}

    </main>
@endsection
