@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создать новый департамент</h1>
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
                            <h3 class="card-title">Новый департамент</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('department-update')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$department->id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInput1">Название департамента (полностью)</label>
                                    <input type="text" name="name" class="form-control" id="exampleInput1" placeholder="Журналистика" value="{{$department->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInput2">Тип департамента (полностью)</label>
                                    <input type="text" name="departmentType" class="form-control" id="exampleInput2" placeholder="Цифровые трансформации" value="{{$department->department_type}}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Создать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
