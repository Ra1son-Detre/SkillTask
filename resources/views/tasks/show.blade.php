@extends('layouts.app')
@section('content')
<h1>Задача:</h1>
@include('partials._task-card')
@include('partials._task-actions')
@include('partials._response-form')

@if($task->executor)
    <p>
        <strong>Текущий исполнитель:</strong>
        {{ $task->executor->name }}
    </p>
@endif

<hr>

@if(auth()->id() === $task->client_id)
    <h2>Отклики</h2>

    @forelse($task->responses as $response)
        <div >
            ---------------------------------------
            <p>
                <strong>Исполнитель:</strong>
                {{ $response->executor->name }}
            </p>

            <p>
                <strong>Сообщение:</strong>
                {{ $response->message }}
            </p>

            <p>
                <strong>Отправлено:</strong>
                {{ $response->created_at->format('Y-m-d H:i') }}
            </p>
            @can('choose-executor', $task)
                <form action="{{ route('tasks.response.choose', [$task, $response]) }}" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit">
                    Подтвердить исполнителя
                </button>
            </form>
                @endcan
            -------------------------------------
        </div>
    @empty
        <p>Пока нет откликов.</p>
    @endforelse
@endif






@endsection
