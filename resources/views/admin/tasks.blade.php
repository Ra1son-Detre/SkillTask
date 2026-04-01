@extends('layouts.admin')

@section('content')

    <h2 class="mb-4">Задачи</h2>

    @include('admin.filters.filter_tasks')

    <table class="table table-striped table-hover table-bordered align-middle">

        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Клиент</th>
            <th>Исполнитель</th>
            <th class="text-center">Цена</th>
            <th>Дата создания</th>
            <th class="text-center">Статус</th>
        </tr>
        </thead>

        <tbody>

        @foreach($tasks as $task)

            <tr>

                <td>{{ $task->id }}</td>

                <td>
                    <a href="{{ route('admin.task.show', $task) }}">
                        {{ $task->title }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('admin.user.show', $task->client) }}">
                        {{ $task->client?->name }}
                    </a>
                </td>

                <td>
                    @if($task->executor)
                        <a href="{{ route('admin.user.show', $task->executor) }}">
                            {{ $task->executor->name }}
                        </a>
                    @else
                        —
                    @endif
                </td>

                <td class="text-center">
                    {{ $task->price }}
                </td>

                <td class="text-center">
                    {{ $task->created_at->format('d.m.Y H:i') }}
                </td>

                <td class="text-center">
                    <span class="badge {{ $task->status->statusColor() }}">
                        {{ $task->status->label() }}
                    </span>
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

@endsection
