@extends('layouts.admin')
@section('header')
    <h1 class="h2">Редактировать данные пользователя</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.users.update',['user' => $user]) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            @error('name') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="email">Email адрес</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
            @error('email') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <br>
        <div class="form-group">
            <p>Права администратора</p>
            <input type="radio" name="is_admin"  value="1" @if($user->is_admin) checked @endif>Да
            <br>
            <input type="radio" name="is_admin"  value="0" @if(!$user->is_admin) checked @endif>Нет
            @error('is_admin') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float:right;">Сохранить</button>
    </form>
@endsection



