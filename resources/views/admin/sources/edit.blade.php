@extends('layouts.admin')
@section('header')
    <h1 class="h2">Редактировать источник данных</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <form method="post" action="{{ route('admin.sources.update', ['source' => $source]) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="link">Адрес RSS-ленты</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ $source->link }}">
            @error('link') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description">{{ $source->description }}</textarea>
            @error('description') <strong style="color:red">{{ $message }}</strong> @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-success" style="float:right;">Сохранить</button>
    </form>
@endsection

