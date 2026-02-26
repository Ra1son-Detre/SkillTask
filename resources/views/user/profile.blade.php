<h1>Profile</h1>
<a href="{{route('tasks.index')}}">Main</a>
<br>
<p><strong>Name:</strong> {{ $user->name ?? null}}</p>
<p><strong>Email:</strong> {{ $user->email ?? null}}</p>
<p><strong>Registered at:</strong> {{ $user->created_at->format('Y-m-d H:i') ?? null}}</p>
<p><strong>Role:</strong> {{ $user->role->label() ?? 'not installed' }}</p>

<form method="POST" action="{{ route('user.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
<h2>Мои задачи с откликами</h2>
@if (auth()->user()->role === \App\Enums\UserRole::EXECUTOR)
    <a href="{{ route('tasks.my.responses') }}">
        Мои задачи
    </a>
    <br>
@endif

@if (auth()->user()->role === \App\Enums\UserRole::CLIENT)
<a href="{{ route('user.tasks.responses') }}">
    Мои задачи с откликами
</a>
@endif
