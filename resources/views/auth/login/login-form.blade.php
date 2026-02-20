
    <h1>Login</h1>



    <form method="POST" action="{{ route('login.try') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email"  required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>

    <a href="{{ route('register.create') }}">Register</a>
