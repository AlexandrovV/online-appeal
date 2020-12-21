@extends('layouts.app')

@section('content')
<div class="row p-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Welcome, {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
