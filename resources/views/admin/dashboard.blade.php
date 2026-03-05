@extends('layouts.admin')

@section('content')

    <h2 class="mb-4">Администраторская панель</h2>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Пользователи</h5>
                    <h2>{{  $statistics['usersCount'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Забаненных</h5>
                    <h2>{{ $statistics['blockedUsers'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5 class="card-title">Задачи</h5>
                    <h2>{{ $statistics['tasksCount'] }}</h2>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-4">

    <h4 class="mb-3">Задачи по стаусам</h4>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h6>Опубликованные</h6>
                    <h3>{{ $statistics['openTasks'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h6> В процессе</h6>
                    <h3>{{ $statistics['inProgressTasks']}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <h6>Завершенные</h6>
                    <h3>{{ $statistics['completedTasks'] }}</h3>
                </div>
            </div>
        </div>

    </div>

@endsection
