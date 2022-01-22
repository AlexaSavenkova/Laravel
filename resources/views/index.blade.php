@extends('layouts.main')
@section('title')
Главная @parent
@stop
@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Главная страница </h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <p>Добро пожаловать на наш сайт!</p>
    </div>
@endsection


