@extends('layouts.main')
@section('title')
    Личный кабинет @parent
@stop
@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Личный кабинет </h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        @include('inc.message')
        <br>
        <h2>Привет, {{ Auth::user()->name }}</h2>
        <br>
        @if(Auth::user()->is_admin)
            <a href="{{ route('admin.index') }}" style="color:red">В админку</a>
        @endif
        <br>
        @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" alt="" style="width:250px;">
        @endif
        <br>
        <a href="{{ route('account.logout') }}">Выход</a>

    </div>
@endsection



