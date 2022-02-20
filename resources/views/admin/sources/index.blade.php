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
                <th>Адрес RSS-ленты</th>
                <th>Описание</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sources as $source)
                <tr>
                    <td>{{ $source->id }}</td>
                    <td>{{ $source->link }}</td>
                    <td>{{ $source->description}}</td>

                    <td><a href="{{ route('admin.sources.edit', ['source'=>$source]) }}">Edit</a>&nbsp;
                        <a href="javascript:;" class="delete" rel="{{ $source->id }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $sources->links() }}
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.querySelectorAll(".delete");
            el.forEach(function (e, k){
                e.addEventListener('click', function () {
                    const id = this.getAttribute('rel');
                    if(confirm(`Подтвердите удаление источника данных с #ID ${id} ?`)) {
                        send('/admin/sources/' + id).then(() =>{
                            location.reload();
                        })
                    }
                });
            });
        });

        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                }
            });
            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush

