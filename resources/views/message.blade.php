@extends('layouts.main')
@section('title')
     @parent
@stop

@section('content')
    <div class="container">
        <x-alert :type="$type" :message="$message"></x-alert>
        <p><a href="{{ route('index') }}" style="text-decoration: none">На главную</a></p>
    </div>
@endsection

