@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Изменить текущего преподавателя</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Изменить преподавателя</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('teacher-update')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$teacher->id}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInput1">Имя</label>
                                    <input type="text" name="first_name" class="form-control" id="exampleInput1" value="{{$teacher->first_name}}" placeholder="Иван">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput2">Фамилия</label>
                                    <input type="text" name="last_name" class="form-control" id="exampleInput2" value="{{$teacher->last_name}}" placeholder="Иванов">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput3">Отчество</label>
                                    <input type="text" name="middle_name" class="form-control" id="exampleInput3" value="{{$teacher->middle_name}}" placeholder="Иванович">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput4">Департамент</label>
                                    <select class="custom-select" id="exampleInput4" name="department_id">
                                        @foreach(\App\Models\Department::all() as $key => $department)
                                            <option {{$department->id == $teacher->department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
