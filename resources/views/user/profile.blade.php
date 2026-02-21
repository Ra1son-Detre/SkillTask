<h1>Profile</h1>

<p><strong>Name:</strong> {{ $user->name ?? null}}</p>
<p><strong>Email:</strong> {{ $user->email ?? null}}</p>
<p><strong>Registered at:</strong> {{ $user->created_at->format('Y-m-d H:i') ?? null}}</p>
<p><strong>Role:</strong> {{ $user->role ?? 'not installed' }}</p>

<form method="POST" action="{{ route('user.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
