<h1>Добро пожаловать</h1>

<a href="{{route('user.profile')}}">Профиль</a>
<br>
@if(auth()->user()->isClient())<a href="{{route('tasks.create')}}">Создать задачу</a>@endif

@if(auth()->user()->isClient())
    <h1>Мои задачи:</h1>
@endif
<br>
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

    @foreach($tasks as $task)
        <div>
            <hr>

            <h3>Задача: {{ $task->title }}</h3>

            <p>Описание: {{ $task->description }}</p>

            <p>Цена: {{ $task->price }}</p>

            <p>Статус: {{ $task->status->label() }}</p>

            <p>Создано: {{ $task->created_at->format('d.m.Y') }}</p>
            <p>Владелец: {{$task->client_id}}</p>

            <a href="{{ route('tasks.show', $task) }}">
                Просмотреть
            </a>
        </div>
    @endforeach

