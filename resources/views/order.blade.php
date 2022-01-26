@extends('layouts.main')
@section('title')
    Заказ @parent
@stop
@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Оставьте ваш заказ</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <x-alert type="danger" :message="$error"></x-alert>
            @endforeach
        @endif
        <form method="post" action="{{ route('order.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="tel">Телефон</label>
                <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel') }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="info">Что вы хотите получить</label>
                <textarea class="form-control" id="info" name="info">{{ old('info') }}</textarea>
            </div>

            <br>
            <button type="submit" class="btn btn-success" style="float:right;">Сохранить</button>
        </form>
    </div>
@endsection

