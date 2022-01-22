@extends('layouts.main')
@section('title')
{{ $news['title'] }} @parent
@stop
@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">{{ $news['title'] }}</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <p>
            <a href="{{ route('news.category', ['slug'=> $news['category_slug']]) }}">
                <strong>{{ $news['category'] }}</strong>
            </a>
        </p>
        <p>Автор: {{ $news['author'] }} &nbsp; Дата добавления: {{ $news['created_at'] }}</p>
        <p>{!! $news['description'] !!}</p>
    </div>
@endsection




