<form method="GET" action="{{ route('admin.users') }}" class="row mb-3 g-2 align-items-end">

    <!-- Поиск -->
    <div class="col-md-3">
        <label class="form-label">Поиск</label>
        <input
            type="text"
            name="filter[search]"
            class="form-control"
            value="{{ request('filter.search') }}"
            placeholder="Имя или email"
        >
    </div>

    <!-- Роль -->
    <div class="col-md-2">
        <label class="form-label">Роль</label>
        <select name="filter[role]" class="form-control">
            <option value="">Все роли</option>

            <option value="{{ \App\Enums\UserRole::CLIENT->value }}"
                @selected(request('filter.role') === \App\Enums\UserRole::CLIENT->value)>
                Клиент
            </option>

            <option value="{{ \App\Enums\UserRole::EXECUTOR->value }}"
                @selected(request('filter.role') === \App\Enums\UserRole::EXECUTOR->value)>
                Исполнитель
            </option>
        </select>
    </div>

    <!-- Блокировка -->
    <div class="col-md-2">
        <label class="form-label">Статус блокировки</label>
        <select name="filter[is_blocked]" class="form-control">
            <option value="">Все</option>

            <option value="1" @selected(request('filter.is_blocked') === '1')>
                Заблокированные
            </option>

            <option value="0" @selected(request('filter.is_blocked') === '0')>
                Активные
            </option>
        </select>
    </div>

    <!-- Сортировка -->
    <div class="col-md-2">
        <label class="form-label">Дата регистрации</label>
        <select name="sort" class="form-control">
            <option value="">Не сортировать</option>

            <option value="-created_at" @selected(request('sort') === '-created_at')>
                Сначала новые
            </option>

            <option value="created_at" @selected(request('sort') === 'created_at')>
                Сначала старые
            </option>
        </select>
    </div>

    <!-- Кнопки -->
    <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            Фильтровать
        </button>

        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
            Сбросить
        </a>
    </div>

</form>
