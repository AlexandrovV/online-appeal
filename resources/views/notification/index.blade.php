@extends('layouts.app')

@section('content')
    <div class="row p-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Лог сообщений</h3>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Время создания</th>
                            <th>Кому</th>
                            <th>Тип отправки</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notifications as $key => $notification)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$notification->created_at}}</td>
                                <td>{{$notification->user_email}}</td>
                                <td>{{$notification->type}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
