@extends('layouts.admin')

@section('content')

    <h2>Task: {{ $task->title }}</h2>

    <div class="mb-4">

        <p><b>Статус:</b> {{ $task->status }}</p>
        <p><b>Цена:</b> {{ $task->price }}</p>

        <p>
            <b>Клиент:</b>
            <a href="{{ route('admin.user.show', $task->client) }}">
                {{ $task->client->name }}
            </a>
        </p>

        @if($task->executor)
            <p>
                <b>Исполнитель:</b>
                <a href="{{ route('admin.user.show', $task->executor) }}">
                    {{ $task->executor->name }}
                </a>
            </p>
        @endif

    </div>

    <hr>

    <h4>Описание</h4>

    <p>{{ $task->description }}</p>

@endsection
