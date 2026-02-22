<h2> <strong> Редактирование </strong></h2>
<a href="{{route('tasks.index')}}">Main</a>
<br>

<form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PATCH')

<x-input label="title" name="title" default-value="{{$task->title}}" ></x-input>
<x-input label="description" name="description" default-value="{{$task->description}}" ></x-input>
<x-input label="price" name="price" default-value="{{$task->price}}" ></x-input>

    <button type="submit">
        Редактировать
    </button>
</form>
