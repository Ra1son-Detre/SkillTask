<form method="GET" class="row mb-3 g-2 align-items-end">

    <!-- Поиск -->
    <div class="col-md-3">
        <label class="form-label">Поиск</label>
        <input type="text" name="search" class="form-control"
               value="{{ request('search') }}" placeholder="Имя или email">
    </div>

    <!-- Роль -->
    <div class="col-md-2">
        <label class="form-label">Роль</label>
        <select name="role" class="form-control">
            <option value="">Все роли</option>
            <option value="{{ \App\Enums\UserRole::CLIENT->value }}"
                @selected(request('role') === \App\Enums\UserRole::CLIENT->value)>
                Клиент
            </option>
            <option value="{{ \App\Enums\UserRole::EXECUTOR->value }}"
                @selected(request('role') === \App\Enums\UserRole::EXECUTOR->value)>
                Исполнитель
            </option>
        </select>
    </div>

    <!-- Заблокированные -->
    <div class="col-md-2">
        <label class="form-label">Статус блокировки</label>
        <select name="is_blocked" class="form-control">
            <option value="">Все</option>
            <option value="1" @selected(request('is_blocked') === '1')>Заблокированные</option>
            <option value="0" @selected(request('is_blocked') === '0')>Активные</option>
        </select>
    </div>

    <!-- Сортировка по дате -->
    <div class="col-md-2">
        <label class="form-label">Дата регистрации</label>
        <select name="date" class="form-control">
            <option value="">Не сортировать</option>
            <option value="asc" @selected(request('date') === 'asc')>Сначала старые</option>
            <option value="desc" @selected(request('date') === 'desc')>Сначала новые</option>
        </select>
    </div>

    <!-- Кнопки -->
    <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Фильтровать</button>
        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">Сбросить</a>
    </div>

</form>
