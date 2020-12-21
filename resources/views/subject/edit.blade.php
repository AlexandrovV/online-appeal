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
                    <form role="form" action="{{route('subject-update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$subject->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInput1">Название предмета</label>
                                <input type="text" name="name" class="form-control" id="exampleInput1" value="{{$subject->subject_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInput2">Департамент</label>
                                <select name="departmentId">
                                    @foreach(App\Models\Department::all() as $key => $department)
                                        <option value="{{$department->id}}" {{$department->id == $subject->department->id ? 'selected' : ''}}>{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
