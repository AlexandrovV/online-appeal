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
                    <h3 class="card-title">Департаменты</h3>
                    <div class="card-tools">
                        <a href="{{route('department-create')}}" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Создать новый</a>
                    </div>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Время создания</th>
                            <th>Название</th>
                            <th>Тип департамента</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $key => $department)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$department->created_at}}</td>
                                <td><a href="{{route('department-get', ['id' => $department->id])}}">{{$department->name}}</a></td>
                                <td>{{$department->department_type}}</td>
                                <td>
                                    <a href="{{route('department-edit', ['id' => $department->id])}}" class="btn btn-outline-info">Изменить</a>
                                    <a href="{{route('department-destroy', ['id' => $department->id])}}" class="btn btn-outline-danger">Удалить</a>
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
