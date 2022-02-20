@extends('layouts.admin')
@section('header')
    <h1 class="h2">Редактировать категорию</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.categories.update', ['category' => $category]) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Наименование</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
            @error('name') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
            @error('description') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float:right;">Сохранить</button>
    </form>
@endsection
