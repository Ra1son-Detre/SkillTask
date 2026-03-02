@if(auth()->id() === $task->client_id && $task->executor_id === null)

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="mb-4">
                Отклики🚨:
            </h5>

            @forelse($task->responses as $response)

                <div class="border rounded p-3 mb-3">

                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong>{{ $response->executor->name }}</strong>
                            <div class="text-muted small">
                                {{ $response->created_at->format('d.m.Y H:i') }}
                            </div>
                        </div>
                    </div>

                    <p class="mb-3">
                        {{ $response->message }}
                    </p>

                    @can('choose-executor', $task)
                        <form action="{{ route('tasks.response.choose', [$task, $response]) }}"
                              method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    class="btn btn-outline-success btn-sm">
                                Подтвердить исполнителя
                            </button>
                        </form>
                    @endcan

                </div>

            @empty
                <div class="text-muted">
                    Пока нет откликов.
                </div>
            @endforelse

        </div>
    </div>

@endif
