@extends('layouts.admin')
@section('header')
    <h1 class="h2">Список пользователей</h1>
@endsection
@section('content')
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Имя</th>
                <th>Email адрес</th>
                <th>Права админиcтратора</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email}}</td>
                    <td>@if($user->is_admin) ДА @else НЕТ @endif</td>

                    <td><a href="{{ route('admin.users.edit', ['user'=>$user]) }}">Edit</a>&nbsp;
                        <a href="javascript:;" class="delete" rel="{{ $user->id }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.querySelectorAll(".delete");
            el.forEach(function (e, k){
                e.addEventListener('click', function () {
                    const id = this.getAttribute('rel');
                    if(confirm(`Подтвердите удаление пользователя с #ID ${id} ?`)) {
                        send('/admin/users/' + id).then(() =>{
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


