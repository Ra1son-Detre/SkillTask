<a href="{{route('tasks.index')}}">Main</a>
<br>

<form method="POST" action="{{ route('register.store') }}">
    @csrf

    <div>
        <label for="name">Имя</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
        <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="role">Role</label>

        <select name="role" id="role" class="form-select" required>
            <option value="}" disabled selected hidden="">--Выберите значение--</option>

            @foreach($roles as $role)
                <option
                    value="{{ $role->value }}"
                    {{ old('role') == $role->value ? 'selected' : '' }}
                >
                    {{ $role->label() }}
                </option>
            @endforeach
        </select>

        @error('role')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">Пароль</label>
        <input id="password" type="password" name="password" required>
        @error('password')
        <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Подтверждение пароля</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">
            Зарегистрироваться
        </button>
    </div>
</form>
<a href="{{route('login')}}">Login</a>
