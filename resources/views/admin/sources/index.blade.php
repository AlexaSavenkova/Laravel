@extends('layouts.admin')
@section('header')
    <h1 class="h2">Список источников данных</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.sources.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить источник данных</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Название</th>
                <th>Описание</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sources as $source)
                <tr>
                    <td>{{ $source->id }}</td>
                    <td>{{ $source->name }}</td>
                    <td>{{ $source->description}}</td>

                    <td><a href="{{ route('admin.sources.edit', ['source'=>$source]) }}">Edit</a>&nbsp;<a href="">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $sources->links() }}
    </div>

@endsection

