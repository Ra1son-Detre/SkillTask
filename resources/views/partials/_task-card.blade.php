<div class="card shadow-sm mb-4">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0">{{ $task->title }}</h3>

            <span class="badge {{$task->status->statusColor()}}">
                {{ $task->status->label() }}
            </span>
        </div>

        <hr>

        <p class="text-muted">
            Дата создания: {{ $task->created_at->format('d.m.Y') }}
        </p>

        <p class="mt-3">
           Описание: {{ $task->description }}
        </p>
        <div class="d-flex align-items-center mt-3">
            <span class="me-2">Вознаграждение:</span>

            <span class="text-success fw-semibold">
        🪙 {{ $task->price }} ₽
    </span>
        </div>

    </div>
</div>
