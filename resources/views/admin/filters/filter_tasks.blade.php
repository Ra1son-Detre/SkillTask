<form method="GET" action="{{ route('admin.tasks') }}" class="row mb-4">

    <div class="col-md-3">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Поиск по названию"
        >
    </div>

    <div class="col-md-2">
        <select name="status" class="form-control">

            <option value="">Все статусы</option>

            @foreach(\App\Enums\TaskStatus::cases() as $status)

                <option
                    value="{{ $status->value }}"
                    {{ request('status') == $status->value ? 'selected' : '' }}
                >
                    {{ $status->label() }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="col-md-2">
        <select name="price" class="form-control">

            <option value="">Цена</option>

            <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>
                Цена ↑
            </option>

            <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>
                Цена ↓
            </option>

        </select>
    </div>

    <div class="col-md-2">
        <select name="date" class="form-control">

            <option value="">Дата</option>

            <option value="desc" {{ request('date') == 'desc' ? 'selected' : '' }}>
                Новые
            </option>

            <option value="asc" {{ request('date') == 'asc' ? 'selected' : '' }}>
                Старые
            </option>

        </select>
    </div>

    <div class="col-md-1">
        <button class="btn btn-primary w-100">
            Фильтр
        </button>
    </div>

    <div class="col-md-2">
        <a href="{{ route('admin.tasks') }}" class="btn btn-secondary w-100">
            Сбросить
        </a>
    </div>

</form>
