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
                <h3 class="card-title">
                    @role('admin|manager|dept')
                        Аппеляции
                    @endrole

                    @role('student')
                        Заявки
                    @endrole
                </h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Студент</th>
                        <th>Предмет</th>
                        <th>Преподаватель</th>
                        <th>Кафедра</th>
                        <th>Статус</th>
                        <th>Время создания</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appeals as $key => $appeal)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$appeal->student->name}}</td>
                        <td>{{$appeal->subject->subject_name}}</td>
                        <td>{{$appeal->teacher->last_name . ' ' . $appeal->teacher->first_name . ' ' . $appeal->teacher->middle_name}}</td>
                        <td>{{$appeal->department->name}}</td>
                        <td>{{$statuses[$appeal->status]}}</td>
                        <td>{{$appeal->created_at}}</td>
                        <td>
                            @role('admin|manager')
                                @if ($appeal->status == 'created')
                                    <a href="{{route('accept-appeal', ['id' => $appeal->id])}}" class="btn btn-outline-info">Принять</a>
                                @endif
                            @endrole

                            @role('admin|dept')
                                @if ($appeal->status == 'waiting')
                                    <a href="{{route('approve-appeal', ['id' => $appeal->id])}}" class="btn btn-outline-info">Подтвердить</a>
                                @endif
                            @endrole

                            @if ($appeal->status != 'cancelled' && $appeal->status != 'accepted')
                                <a href="{{route('cancel-appeal', ['id' => $appeal->id])}}" class="btn btn-outline-danger">Отменить</a>
                            @endif

                            @if ($appeal->status == 'accepted')
                                <a href="{{route('appeal-browser', ['id' => $appeal->id])}}" target="_blank" class="btn btn-outline-info">Открыть PDF</a>
                            @endif
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
