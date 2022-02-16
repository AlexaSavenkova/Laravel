@extends('layouts.main')
@section('title')
{{ $news->title }} @parent
@stop
@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">{{ $news->title }}</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <h4>Категории:</h4>
        @foreach($news->categories as $category)
            {{ $category->name }},
        @endforeach
        <p>Автор: {{ $news->author }} &nbsp; Дата добавления: {{ $news->created_at }}</p>
        <p>{!! $news->description !!}</p>
        <p><a href="{{ $news->link }}">Подробнее</a></p>

    </div>
@endsection




