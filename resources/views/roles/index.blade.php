@extends('layouts.app')

@section('content')
@if (session('status') == 'success')
<div class="alert alert-success alert-dismissible m-3">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Успех</h5>
    Операция успешно выполнена
</div>
@elseif (session('status') == 'updated')
<div class="alert alert-info alert-dismissible m-3">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Успех</h5>
    Операция успешно провела обновление
</div>
@endif
<div class="row p-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Управление ролями</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>E-mail</th>
                        <th>Администратор</th>
                        <th>Менеджер</th>
                        <th>Студент</th>
                        <th>Кафедра</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <form action="{{route('sync-roles')}}" method="post">
                        <input type="hidden" value="{{ $user->id }}" name="userId" />
                        @csrf
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><input type="checkbox" {{ $user->hasRole('admin') ? 'checked' : '' }} name="role_admin"></td>
                            <td><input type="checkbox" {{ $user->hasRole('manager') ? 'checked' : '' }} name="role_manager"></td>
                            <td><input type="checkbox" {{ $user->hasRole('student') ? 'checked' : '' }} name="role_student"></td>
                            <td><input type="checkbox" {{ $user->hasRole('dept') ? 'checked' : '' }} name="role_dept"></td>
                            <td><button type="submit" class="btn btn-outline-info">Изменить</button></td>
                        </tr>
                    </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
