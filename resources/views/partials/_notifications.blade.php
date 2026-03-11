@php
    $user = auth()->user();
    $notifications = $user->unreadNotifications ?? collect();
@endphp

@if($notifications->count() > 0)
    <div class="mb-3">
        <h6 class="fw-bold">🔔 Уведомления ({{ $notifications->count() }})</h6>
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item p-2">
                    <a href="{{ route('tasks.show', ['task' => $notification->data['task_id'], 'notification' => $notification->id]) }}"
                       class="text-decoration-none">
                        {{ $notification->data['message'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@else
    <p class="text-muted">Нет новых уведомлений</p>
@endif
