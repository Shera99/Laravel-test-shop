@extends('master')

@section('title', 'Ктегория ' . $category->name)

@section('content')
    <div class="starter-template">
        <h1>
            {{ $category->name }}
        </h1>

        @if($category->description !== '')
        <p>
            {{ $category->description }}
        </p>
        @endif

        <div class="row">

            @include('card', ['category' => $category])

        </div>
    </div>
@endsection
