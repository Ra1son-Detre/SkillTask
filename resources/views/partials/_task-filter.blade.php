<form method="GET" action="{{ route('tasks.index') }}" class="row g-2 mb-4">

    <div class="col-md-4">
        <input type="text"
               name="filter[title]"
               class="form-control"
               placeholder="Поиск по названию"
               value="{{ request('filter.title') }}">
    </div>

    <div class="col-md-4">
        <select name="sort" class="form-select">
            <option value="">Сортировка</option>
            <option value="price" @selected(request('sort') === 'price')>Цена ↑</option>
            <option value="-price" @selected(request('sort') === '-price')>Цена ↓</option>
            <option value="created_at" @selected(request('sort') === 'created_at')>Сначала старые</option>
            <option value="-created_at" @selected(request('sort') === '-created_at')>Сначала новые</option>
        </select>
    </div>

    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary">
            Фильтр
        </button>
    </div>

</form>
