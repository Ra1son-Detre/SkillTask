@if(auth()->user()->role === \App\Enums\UserRole::CLIENT)
<div class="mb-4 d-flex flex-wrap justify-content-center gap-3">

    <a href="{{ route('tasks.create') }}" class="btn btn-light border">
        ✍️ Создать задачу
    </a>

    <a href="{{ route('tasks.index', ['status' => 'draft']) }}" class="btn btn-secondary">
        ✏️ Не опубликованные
    </a>

    <a href="{{ route('tasks.index', ['status' => 'published']) }}" class="btn text-white"
       style="background-color: #6f42c1;">
        📢 Опубликованные
    </a>

    <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}" class="btn btn-warning">
        ⚙️ В работе
    </a>
    <a href="{{ route('tasks.index', ['status' => 'awaiting_confirmation']) }}"  class="btn btn-info text-dark">
        📌 Ожидающие оплаты
    </a>

    <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="btn btn-success">
        ✅ Выполненные
    </a>

    <a href="{{ route('tasks.index', ['status' => 'cancelled']) }}" class="btn btn-danger">
        ✖ Отмененные
    </a>

</div>
@endif

@if(auth()->user()->role === \App\Enums\UserRole::EXECUTOR)
    <div class="mb-4 d-flex flex-wrap justify-content-center gap-3">

        <a href="{{ route('tasks.index', ['status' => 'published']) }}" class="btn btn-secondary">
            📋 Опубликованные задачи
        </a>

        <a href="{{ route('tasks.index', ['status' => 'my_response']) }}" class="btn btn-info text-dark">
            📤 На рассмотрении
        </a>

        <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}"  class="btn text-white"
           style="background-color: #6f42c1;">
            📌 Задачи в работе
        </a>

        <a href="{{ route('tasks.index', ['status' => 'awaiting_confirmation']) }}" class="btn btn-warning">
            ⏳ Ожидающие подтверждения
        </a>

        <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="btn btn-success">
            ✅ Выполненные
        </a>

    </div>
@endif
