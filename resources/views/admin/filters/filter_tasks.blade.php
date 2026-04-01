<form method="GET" action="{{ route('admin.tasks') }}" class="row mb-4">

    <!-- Поиск -->
    <div class="col-md-3">
        <input
            type="text"
            name="filter[title]"
            value="{{ request('filter.title') }}"
            class="form-control"
            placeholder="Поиск по названию"
        >
    </div>

    <!-- Статус -->
    <div class="col-md-2">
        <select name="filter[status]" class="form-control">
            <option value="">Все статусы</option>

            @foreach(\App\Enums\TaskStatus::cases() as $status)
                <option
                    value="{{ $status->value }}"
                    @selected(request('filter.status') == $status->value)
                >
                    {{ $status->label() }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Сортировка -->
    <div class="col-md-3">
        <select name="sort" class="form-control">
            <option value="">Сортировка</option>

            <option value="price" @selected(request('sort') === 'price')>
                Цена ↑
            </option>

            <option value="-price" @selected(request('sort') === '-price')>
                Цена ↓
            </option>

            <option value="-created_at" @selected(request('sort') === '-created_at')>
                Новые
            </option>

            <option value="created_at" @selected(request('sort') === 'created_at')>
                Старые
            </option>
        </select>
    </div>

    <!-- Кнопка -->
    <div class="col-md-2">
        <button class="btn btn-primary w-100">
            Фильтр
        </button>
    </div>

    <!-- Сброс -->
    <div class="col-md-2">
        <a href="{{ route('admin.tasks') }}" class="btn btn-secondary w-100">
            Сбросить
        </a>
    </div>

</form>
