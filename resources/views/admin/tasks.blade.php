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
            <th class="text-center" style="width:120px;">Статус</th>
            <th style="width:320px;">Изменить Статус</th>
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

                <td style="white-space: nowrap;">

                    <form
                        action="{{ route('admin.tasks.status', $task) }}"
                        method="POST"
                        class="d-flex gap-2"
                    >

                        @csrf
                        @method('PATCH')

                        <select name="status" class="form-select form-select-sm">

                            @foreach(\App\Enums\TaskStatus::cases() as $status)

                                <option
                                    value="{{ $status->value }}"
                                    @selected($task->status === $status)
                                >

                                    {{ $status->label() }}

                                </option>

                            @endforeach

                        </select>

                        <button class="btn btn-sm btn-outline-primary">
                            Сахранить
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

@endsection
