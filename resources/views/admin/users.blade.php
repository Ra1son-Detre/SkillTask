<h1>Users List</h1>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->value }}</td>
            <td>
                <form action="{{ route('admin.users.block', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="submit">
                        {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>


