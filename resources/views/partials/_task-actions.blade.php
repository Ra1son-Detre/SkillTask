@canany(['update', 'delete', 'publish', 'draft', 'confirm-and-pay',], $task)
    <div class="card shadow-sm mb-4">
    <div class="card-body">


        <h5 class="mb-3">Действия</h5>

        <div class="d-flex flex-wrap gap-2">

            {{-- Редактировать --}}
            @can('update', $task)
                <a href="{{ route('tasks.edit', $task) }}"
                   class="btn btn-outline-primary">
                    Редактировать
                </a>
            @endcan

            {{-- Удалить --}}
            @can('delete', $task)
                <form method="POST"
                      action="{{ route('tasks.destroy', $task) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger">
                        Удалить
                    </button>
                </form>
            @endcan

            {{-- Опубликовать --}}
            @if($task->status === \App\Enums\TaskStatus::DRAFT)
                @can('publish', $task)
                    <form method="POST"
                          action="{{ route('tasks.publish', $task) }}">
                        @csrf
                        @method('PATCH')

                        <button class="btn btn-info">
                            Опубликовать
                        </button>
                    </form>
                @endcan
            @endif

            {{-- Вернуть в черновик --}}
            @can('draft', $task)
                <form method="POST"
                      action="{{ route('tasks.draft', $task) }}">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-secondary">
                        Отменить
                    </button>
                </form>
            @endcan

            {{-- Подтвердить и оплатить --}}
            @can('confirm-and-pay', $task)
                <form method="POST"
                      action="{{ route('tasks.confirmAndPay', $task) }}">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-success">
                        Подтвердить и вознаградить
                    </button>
                </form>
            @endcan

        </div>

    </div>
</div>
@endcanany


@can('completeByExecutor', $task)
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">Действия</h5>
        <div class="d-flex flex-wrap gap-2">

                <form method="POST"
                      action="{{ route('tasks.report', $task) }}">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-success">
                        Сообщить о выполнении работы
                    </button>
                </form>

        </div>

    </div>
</div>
@endcan
