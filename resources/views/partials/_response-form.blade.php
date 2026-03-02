@if(auth()->user()->role === \App\Enums\UserRole::EXECUTOR)

    @can('respond', $task)

            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Откликнуться на задачу  📨</h5>

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
