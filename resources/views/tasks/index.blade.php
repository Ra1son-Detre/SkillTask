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

    <input type="number" name="min_price" placeholder="Мин. цена"
           value="{{ request('min_price') }}">

    <input type="number" name="max_price" placeholder="Макс. цена"
           value="{{ request('max_price') }}">

    <input type="date" name="date_from"
           value="{{ request('date_from') }}">

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

            <a href="{{ route('tasks.show', $task) }}">
                Просмотреть
            </a>
        </div>
    @endforeach

