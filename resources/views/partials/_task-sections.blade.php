@if(auth()->user()->role === \App\Enums\UserRole::CLIENT)
<div class="mb-4 d-flex flex-wrap justify-content-center gap-3">

    <a href="{{ route('tasks.create') }}" class="btn btn-light border">
        ✍️ Создать задачу
    </a>

    <a href="{{ route('tasks.index', ['status' => 'draft']) }}" class="btn btn-secondary">
        📝 Не опубликованные
    </a>

    <a href="{{ route('tasks.index', ['status' => 'published']) }}" class="btn btn-info text-dark">
        📢 Опубликованные
    </a>

    <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}" class="btn btn-warning">
        ⚙️ В работе
    </a>

    <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="btn btn-success">
        ✅ Выполненные
    </a>

</div>
@endif

@if(auth()->user()->role === \App\Enums\UserRole::EXECUTOR)
    <div class="mb-4 d-flex flex-wrap justify-content-center gap-3">

        <a href="{{ route('tasks.index', ['status' => 'draft']) }}" class="btn btn-secondary">
            📋 Все задачи
        </a>

        <a href="{{ route('tasks.create') }}" class="btn btn-secondary">
            📤 Мои отклики
        </a>

        <a href="{{ route('tasks.index', ['status' => 'draft']) }}" class="btn btn-info text-dark">
            📌 Мои активные задачи
        </a>

        <a href="{{ route('tasks.index', ['status' => 'published']) }}" class="btn btn-warning">
            ⏳ Ожидающие подтверждения
        </a>

        <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="btn btn-success">
            ✅ Выполненные
        </a>

    </div>
@endif
