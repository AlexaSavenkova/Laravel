@extends('layouts.admin')
@section('header')
    <h1 class="h2">Добавить категорию</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Наименование</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            @error('description') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float:right;">Сохранить</button>
    </form>
@endsection
