<h1>Характеристики</h1>
<a href="{{route('tasks.index')}}">Main</a>
<br>
<a href="{{route('user.profile')}}">Профиль</a>
<br>
@if(auth()->user()->isClient()) <a href="{{route('tasks.create')}}">Создать задачу</a> @endif

<h1>Задача:</h1>


    <div>
        <h1>------------------------</h1>
        <h3>Задча: {{ $task->title }}</h3>

        <p>Описание: {{ $task->description }}</p>

        <p>
            Цена: {{ $task->price}}
        </p>

        <p>
            Статус: {{ $task->status->label() }}
        </p>

        <p>
            Создано: {{ $task->created_at->format('d.m.Y ') }}
        </p>

        @can('update', $task) <a href="{{route('tasks.edit', $task)}}">Редактировать</a>@endcan
        <br></br>
        @can('delete', $task)
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Вы точно хотите удалить задачу?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-outline-danger">Удалить</button>
        </form>
        @endcan

        @if($task->status === \App\Enums\TaskStatus::DRAFT)
            <form action="{{ route('tasks.publish', $task) }}" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit">
                    Опубликовать
                </button>
            </form>
        @endif

        @can('draft', $task)
            <form action="{{ route('tasks.draft', $task) }}" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit">
                    Отменить и перевести в черновик
                </button>
            </form>
        @endcan

        @can('respond', $task)
            <div class="card mt-4">
                <div class="card-body">
                    <h5>Откликнуться на задачу</h5>

                    <form action="{{ route('tasks.response.store', $task) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                        <textarea
                            name="message"
                            class="form-control"
                            rows="4"
                            placeholder="Введите комментарий"
                            required
                        ></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Откликнуться
                        </button>
                    </form>
                </div>
            </div>
        @endcan
        <h1>------------------------</h1>
    </div>

