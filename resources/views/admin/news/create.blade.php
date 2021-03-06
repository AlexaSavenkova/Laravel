@extends('layouts.admin')
@section('header')
    <h1 class="h2">Добавить запись</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.news.store') }}">
        @csrf
        <div class="form-group">
            <label for="categories">Выбрать категории</label>
            <select class="form-control" id="categories" name="categories[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('categories') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            @error('title') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
            @error('author') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="source_id">Источник</label>
            <select class="form-control" id="source_id" name="source_id">
                @foreach($sources as $source)
                    <option value="{{ $source->id }}">{{$source->link}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" class="form-control">
                <option @if(old('status')==='DRAFT') selected @endif>DRAFT</option>
                <option @if(old('status')==='ACTIVE') selected @endif>ACTIVE</option>
                <option @if(old('status')==='BLOCKED') selected @endif>BLOCKED</option>
            </select>
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

