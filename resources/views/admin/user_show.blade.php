@extends('layouts.admin')

@section('content')

    <h2>Пользователь: {{ $user->name }} (id:{{$user->id}})</h2>

    <div class="mb-4">

        <p><b>Email:</b> {{ $user->email }}</p>
        <p><b>Роль:</b> {{ $user->role->label() }}</p>

        <p><b>Дата регистрации:</b> {{ $user->created_at }}</p>

        <form action="{{ route('admin.user.block', $user) }}" method="POST">

            @csrf
            @method('PATCH')

            @if(!$user->is_blocked)

                <button class="badge bg-danger border-0"
                        onclick="return confirm('Вы уверены?')">
                    Заблокировать
                </button>

            @else

                <button class="badge bg-success border-0">
                    Разблокировать
                </button>

            @endif

        </form>

    </div>

    <hr>

    <h4><strong>Все задачи клиента: </strong></h4>

    <table class="table table-bordered">

        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Статус</th>
            <th>Цена</th>
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
                    <span class="badge {{$task->status->statusColor()}}">
                {{ $task->status->label() }}
            </span></td>

                <td>{{ $task->price }}</td>

            </tr>

        @endforeach

        </tbody>

    </table>



@endsection
