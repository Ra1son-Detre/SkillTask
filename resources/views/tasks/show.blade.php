@extends('layouts.app')
@section('content')
<h1>Задача:</h1>
@include('partials._task-card')
@include('partials._response-form')
@include('partials._responses-show')
@include('partials._executor-state')
@include('partials._task-actions')

@if($task->executor && auth()->user()->role === \App\Enums\UserRole::CLIENT)
    <div class="border rounded p-3 mb-4 bg-light">

        <div class="text-muted small mb-1">
            Исполнитель задачи
        </div>

        <div class="fs-4 fw-bold">
            {{ $task->executor->name }}
        </div>

    </div>
@endif


@endsection
