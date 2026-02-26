<h1>Мои задачи с откликами</h1>

<a href="{{ route('user.profile') }}">← Назад в профиль</a>
<br><br>

@forelse($tasks as $task)
    <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">
        <h3>{{ $task->title }}</h3>

        <p><strong>Цена:</strong> {{ $task->price }}</p>
        <p><strong>Статус:</strong> {{ $task->status->label() }}</p>

        <p><strong>Откликов:</strong> {{ $task->responses->count() }}</p>

        <a href="{{ route('tasks.show', $task) }}">
            Смотреть отклики
        </a>
    </div>
@empty
    <p>Пока нет задач с откликами.</p>
@endforelse

