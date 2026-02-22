<h1>Характеристики</h1>
<a href="{{route('tasks.index')}}">Main</a>
<br>
<a href="{{route('user.profile')}}">Профиль</a>
<br>
<a href="{{route('tasks.create')}}">Создать задачу</a>

<h1>Задача:</h1>


    <div>
        <h1>------------------------</h1>
        <h3>Задча: {{ $task->title }}</h3>

        <p>Описание: {{ $task->description }}</p>

        <p>
            Цена: {{ $task->price}}
        </p>

        <p>
            Статус: {{ $task->status->value }}
        </p>

        <p>
            Создано: {{ $task->created_at->format('d.m.Y ') }}
        </p>
        <a href="{{route('tasks.edit', $task)}}">Редактировать</a>
        <br></br>
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Вы точно хотите удалить задачу?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-outline-danger">Удалить</button>
        </form>
        <h1>------------------------</h1>
    </div>

