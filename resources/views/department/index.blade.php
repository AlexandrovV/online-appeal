@extends('layouts.app')

@section('content')
    <div class="row p-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Департаменты</h3>
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
                                    <button class="btn btn-outline-warning">Изменить</button>
                                    <button class="btn btn-outline-danger">Удалить</button>
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
