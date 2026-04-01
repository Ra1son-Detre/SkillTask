@extends('layouts.admin')

@section('content')

    <h2 class="mb-4">Task: {{ $task->title }}</h2>

    <div class="mb-4">

        <p>
            <b>Статус:</b>
            <span class="badge {{ $task->status->statusColor() }}">
                {{ $task->status->label() }}
            </span>
        </p>

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

    <hr>

    <!-- 🔥 УПРАВЛЕНИЕ СТАТУСОМ -->
    <h4>Изменить статус</h4>

    <form action="{{ route('admin.tasks.status', $task) }}" method="POST" class="d-flex gap-2">

        @csrf
        @method('PATCH')

        <select name="status" class="form-select" style="max-width: 250px;">

            @foreach(\App\Enums\TaskStatus::cases() as $status)
                <option
                    value="{{ $status->value }}"
                    @selected($task->status === $status)
                >
                    {{ $status->label() }}
                </option>
            @endforeach

        </select>

        <button class="btn btn-primary">
            Сохранить
        </button>

    </form>

@endsection
