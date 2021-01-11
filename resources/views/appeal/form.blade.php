@extends('layouts.app')

@section('content')
    <div class="row p-5">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Заявка на аппеляцию</h3>
                </div>

                <form action="{{route('appeal-create')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="departmentId" value="{{ $department->id }}"/>
                        <div class="form-group">
                            <label for="selectDep">Кафедра</label>
                            <select id="selectDep" class="form-control select2" disabled>
                                <option value="{{$department->id}}" selected>{{$department->name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectSubject">Предмет</label>
                            <select id="selectSubject" class="form-control select2" name="subjectId">
                                @foreach(App\Models\Subject::all() as $key => $subject)
                                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectTeacher">Учитель</label>
                            <select id="selectTeacher" class="form-control select2" name="teacherId">
                                @foreach(App\Models\Teacher::all() as $key => $teacher)
                                    <option
                                        value="{{$teacher->id}}">{{$teacher->last_name . ' ' . $teacher->first_name . ' ' . $teacher->middle_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">Заявление</label>
                            <textarea name="text" class="form-control" id="text" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
@endsection
