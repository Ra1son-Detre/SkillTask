@if(auth()->user()->role === \App\Enums\UserRole::EXECUTOR)

    @if($task->viewResponseForm(auth()->user()) && $task->status === \App\Enums\TaskStatus::PUBLISHED)
        <div class="card shadow-sm mb-4 border-primary">
            <div class="card-body text-center">
                <h5 class="text-warning mb-2">
                    ⏳ Вы уже откликнулись на эту задачу
                </h5>
                <p class="text-muted mb-0">
                    Ожидайте решения заказчика.
                </p>
            </div>
        </div>
    @endif

        @can('respond', $task)

            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Откликнуться на задачу</h5>

                    <form action="{{ route('tasks.response.store', $task) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                        <textarea
                            name="message"
                            class="form-control"
                            rows="4"
                            placeholder="Введите комментарий"
                            required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Откликнуться
                        </button>
                    </form>

                </div>
            </div>

        @endcan

    @endif
