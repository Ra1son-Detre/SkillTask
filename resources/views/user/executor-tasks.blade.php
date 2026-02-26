<h1>Мои задачи</h1>

<a href="{{ route('user.profile') }}">← Назад в профиль</a>
<br><br>
<form method="GET" action="{{ route('tasks.index') }}">

    <input type="text" name="search" placeholder="Поиск по названию"
           value="{{ request('search') }}">

    <select name="price_sort">
        <option value="">Цена</option>
        <option value="asc">По возрастанию</option>
        <option value="desc">По убыванию</option>
    </select>

    <select name="date_sort">
        <option value="">Дата</option>
        <option value="asc">Сначала старые</option>
        <option value="desc">Сначала новые</option>
    </select>
    <button type="submit">Фильтр</button>

</form>

<hr>

<h2>Задачи в работе</h2>

@forelse($tasks['active'] as $task)
    <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">
        <h3>{{ $task->title }}</h3>
        <p><strong>Цена:</strong> {{ $task->price }}</p>
        <p><strong>ID:</strong> {{ $task->id }}</p>
        <p><strong>Статус:</strong> {{ $task->status->label() }}</p>

        <a href="{{ route('tasks.show', $task) }}">
            Смотреть задачу
        </a>
    </div>
@empty
    <p>У вас нет активных задач.</p>
@endforelse


<hr>

<h2>Выполненные задачи</h2>

@forelse($tasks['completed'] as $task)
    <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">
        <h3>{{ $task->title }}</h3>
        <p><strong>Цена:</strong> {{ $task->price }}</p>
        <p><strong>ID:</strong> {{ $task->id }}</p>
        <p><strong>Статус:</strong> {{ $task->status->label() }}</p>

        <a href="{{ route('tasks.show', $task) }}">
            Смотреть задачу
        </a>
    </div>
@empty
    <p>У вас нет выполненных задач.</p>
@endforelse

