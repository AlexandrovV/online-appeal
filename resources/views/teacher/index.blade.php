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
                    <h3 class="card-title">Преподаватели</h3>
                    <div class="card-tools">
                        <a href="{{route('teacher-create')}}" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Создать нового</a>
                    </div>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Время создания</th>
                            <th>ФИО</th>
                            <th>Принадлежит департаменту</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $key => $teacher)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$teacher->created_at}}</td>
                                <td><a href="{{route('teacher-get', ['id' => $teacher->id])}}">{{$teacher->last_name}} {{$teacher->first_name}} {{$teacher->middle_name}}</a></td>
                                <td>{{$teacher->department->name}}</td>
                                <td>
                                    <a href="{{route('teacher-edit', ['id' => $teacher->id])}}" class="btn btn-outline-info">Изменить</a>
                                    <a href="{{route('teacher-destroy', ['id' => $teacher->id])}}" class="btn btn-outline-danger">Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
