@extends('layouts.admin')

@section('content')
    @include('admin.filters.filter_users')

    <table class="table table-striped table-bordered align-middle">

        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Статус</th>
            <th>Дата регистрации</th> <!-- Новая колонка -->
            <th width="150">Действия</th>
        </tr>
        </thead>

        <tbody>

        @foreach($users as $user)

            <tr>

                <td>{{ $user->id }}</td>

                <td>
                    <a href="{{ route('admin.user.show', $user) }}">
                        {{ $user->name }}
                    </a>
                </td>

                <td>{{ $user->email }}</td>

                <td>
                <span class="badge bg-info">
                    {{ $user->role }}
                </span>
                </td>

                <td>
                    @if($user->is_blocked)
                        <span class="badge bg-danger">Забанен</span>
                    @else
                        <span class="badge bg-success">Активен</span>
                    @endif
                </td>

                <td class="text-center"> <!-- Новая ячейка с датой -->
                    {{ $user->created_at->format('d.m.Y H:i') }}
                </td>

                <td>
                    <form method="POST"
                          action="{{ route('admin.user.block', $user) }}">
                        @csrf
                        @method('PATCH')

                        @if($user->is_blocked)
                            <button class="btn btn-success btn-sm">
                                Разбанить
                            </button>
                        @else
                            <button class="btn btn-danger btn-sm">
                                Забанить
                            </button>
                        @endif
                    </form>
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

@endsection

