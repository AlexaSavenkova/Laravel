@extends('layouts.admin')
@section('header')
    <h1 class="h2">Админка</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
        Панель администратора
        <br>
        @include('inc.message')

    </div>
@endsection
@push('js')
    <script>
        console.log('Testing stack/push');
    </script>
@endpush

