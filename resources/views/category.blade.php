@extends('layouts.master')

@section('title', 'Ктегория ' . $category->name)

@section('content')
    <h1>
    {{ $category->name }} {{ $category->products->count() }}
    <!-- dump($category->products->last() or first()) -->
    </h1>

    @if($category->description !== '')
        <p>
            {{ $category->description }}
        </p>
    @endif

    <div class="row">
        @foreach($category->products as $product)
            @include('layouts.card', compact('category', 'product'))
        @endforeach
    </div>
@endsection
