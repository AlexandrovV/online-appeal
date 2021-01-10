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
                                @if ($appeal->status == 'created' && $appeal->can_process)
                                     <a class="btn btn-outline-info" data-toggle="modal" id="approvalButton" data-target="#approvalModal" data-attr="{{$appeal->id}}">Обработать</a>
                                @endif
                            @endrole

                            @role('admin|dept')
                                @if ($appeal->status == 'waiting')
                                    <a href="{{route('approve-appeal', ['id' => $appeal->id])}}" class="btn btn-outline-info">Подтвердить</a>
                                @endif

                                @if ($appeal->status != 'cancelled' && $appeal->status != 'accepted')
                                    <a href="{{route('cancel-appeal', ['id' => $appeal->id])}}" class="btn btn-outline-danger">Отменить</a>
                                @endif
                            @endrole

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

<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Подтверждение апелляции</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mediumBody">
                <form action="{{route('manager-process-appeal')}}" method="post">
                    @csrf
                    <input id="appealId" name="appealId" type="hidden"/>
                    <div class="form-group">
                        <label for="selectSubject">Комментарий</label>
                        <input type="text" class="form-control" placeholder="Комментарий" name="comment" required>
                    </div>
                    <div class="form-group">
                        <label for="selectSubject">Предмет</label>
                        <select id="selectSubject" name="status">
                            <option value="accepted">Принять</option>
                            <option value="declined">Отклонить</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-info">Обработать</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<script>
    $(document).on('click', '#approvalButton', function(event) {
        event.preventDefault();
        let appealId = $(this).attr('data-attr');
        $('#appealId').val(appealId);
    });
</script>
@endsection
