@extends('layouts.app')
@section('content')

<h1>Tasks List</h1>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Client</th>
        <th>Executor</th>
        <th>Status</th>
        <th>Change Status</th>
    </tr>

    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->client?->name }}</td>
            <td>{{ $task->executor?->name ?? '—' }}</td>
            <td>{{ $task->status->value }}</td>
            <td>
                <form action="{{ route('admin.tasks.status', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <select name="status">
                        @foreach(\App\Enums\TaskStatus::cases() as $status)
                            <option value="{{ $status->value }}"
                                @selected($task->status === $status)>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>


@endsection
