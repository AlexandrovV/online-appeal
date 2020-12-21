@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$teacher->id}} - {{$teacher -> last_name}} {{$teacher -> first_name}} {{$teacher -> middle_name}}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Учитель # {{$teacher -> id}}</h3>

                <div class="card-tools">
                    <a href="{{route('teacher-all')}}" class="btn btn-tool">
                        <i class="fas fa-arrow-circle-left"></i></a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <h4 class="info-box-text text-muted">ID в системе: {{$teacher -> id}}</h4>
                                        <p class="info-box-text text-muted">Имя учителя: {{$teacher -> first_name}}</p>
                                        <p class="info-box-text text-muted">Фамилия учителя: {{$teacher -> last_name}}</p>
                                        <p class="info-box-text text-muted">Отчество учителя: {{$teacher -> last_name}}</p>
                                        <p class="info-box-text text-muted">Принадлежит кафедре: {{$teacher -> department -> name}}</p>
                                        <p class="info-box-text text-muted">Дата создания: {{$teacher -> created_at}}</p>
                                        <p class="info-box-text text-muted">Дата изменения: {{$teacher -> updated_at}}</p>
                                        <div class="info-box-more">
                                            <span class="text-muted">Действия: </span>
                                            <a href="{{route('teacher-edit', ['id' => $teacher->id])}}" class="m-2 btn btn-outline-info">Изменить</a>
                                            <a href="{{route('teacher-destroy', ['id' => $teacher->id])}}" class="m-2 btn btn-outline-danger">Удалить</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
