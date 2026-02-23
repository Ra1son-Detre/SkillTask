<a href="{{route('tasks.index')}}">Main</a>
<br>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div>
    <label for="text">Заголовок</label>
    <input type="text" name="title">
    </div>

    <br>

    <div>
    <label for="description">Описание</label>
    <textarea name="description"></textarea>
    </div>

    <br>

    <div>
        <label for="description">Цена</label>
    <input type="number" name="price" step="0.01" >
    </div>


    <button type="submit">Create</button>
</form>
