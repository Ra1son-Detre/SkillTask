<h1>Добро пожаловать</h1>

<a href="{{route('user.profile')}}">Профиль</a>
<br>
<a href="{{route('tasks.create')}}">Создать задачу</a>

<h1>Мои задачи:</h1>


    @foreach($tasks as $task)
        <div>
            <hr>

            <h3>Задача: {{ $task->title }}</h3>

            <p>Описание: {{ $task->description }}</p>

            <p>Цена: {{ $task->price }}</p>

            <p>Статус: {{ $task->status->value }}</p>

            <p>Создано: {{ $task->created_at->format('d.m.Y') }}</p>

            <a href="{{ route('tasks.show', $task) }}">
                Просмотреть
            </a>
        </div>
    @endforeach

