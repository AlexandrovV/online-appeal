@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$department->id}} - {{$department -> name}}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Кафедра {{$department -> name}}</h3>

                <div class="card-tools">
                    <a href="{{route('department-all')}}" class="btn btn-tool">
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
                                        <h4 class="info-box-text text-muted">ID в системе: {{$department -> id}}</h4>
                                        <p class="info-box-text text-muted">Название кафедры: {{$department -> name}}</p>
                                        <p class="info-box-text text-muted">Тип кафедры: {{$department -> department_type}}</p>
                                        <p class="info-box-text text-muted">Дата создания: {{$department -> created_at}}</p>
                                        <p class="info-box-text text-muted">Дата изменения: {{$department -> updated_at}}</p>
                                        <div class="info-box-more">
                                            <span class="text-muted">Действия: </span>
                                            <a href="" class="btn btn-outline-info m-2">Редактировать</a>
                                            <a href="" class="btn btn-outline-danger m-2">Удалить</a>
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
