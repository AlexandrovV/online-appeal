<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<!--    <div class="login-logo">-->
<!--        <a href="../../index2.html"><b>Admin</b>LTE</a>-->
<!--    </div>-->
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Registration</p>

            <form action="{{route('sign-up')}}" method="post">
                @csrf
                <label for="selectDep">Кафедра</label>
                <select id="selectDep" name="departmentId" class="form-control">
                    @foreach(App\Models\Department::all() as $key => $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>

                <div class="input-group mb-3">
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="ФИО" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="E-mail" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Пароль" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Подтверждение пароля" name="passwordConfirm">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password-confirm')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @error('unexpected')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('login') }}">Уже есть аккаунт?</a>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Регистрация</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
