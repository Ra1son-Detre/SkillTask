<form method="GET" action="{{ route('tasks.index') }}" class="row g-2 mb-4">

    <div class="col-md-4">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Поиск по названию"
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="price_sort" class="form-select">
            <option value="">Цена</option>
            <option value="asc" @selected(request('price_sort') === 'asc')>
            По возрастанию
            </option>
            <option value="desc" @selected(request('price_sort') === 'desc')>
            По убыванию
            </option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="date_sort" class="form-select">
            <option value="">Дата</option>
            <option value="asc" @selected(request('date_sort') === 'asc')>
            Сначала старые
            </option>
            <option value="desc" @selected(request('date_sort') === 'desc')>
            Сначала новые
            </option>
        </select>
    </div>

    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary">
            Фильтр
        </button>
    </div>

</form>
