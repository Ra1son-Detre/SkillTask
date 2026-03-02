@switch($task->viewExecutorState(auth()->user()))

    @case('responded')
        <h5 class="text-primary mb-2">
            👀 Вы уже откликнулись на эту задачу
        </h5>
        <p class="text-muted mb-0">
            Ожидайте решения заказчика.
        </p>
    @break

    @case('progress')
        <h5 class="text-warning mb-3">
            🛠 Работа в процессе
        </h5>

        <p class="text-muted mb-3">
            После завершения нажмите кнопку ниже.
        </p>
    @break

    @case('awaiting_confirmation')
        <h5 class="text-info mb-2">
            ⏳ Работа отправлена на подтверждение
        </h5>
        <p class="text-muted mb-0">
            Ожидайте подтверждения и оплаты от клиента.
        </p>

    @break

    @case('completed')
        <h5 class="text-success mb-2">
            ✅ Задача успешно выполнена
        </h5>
        <p class="text-muted mb-0">
            Оплата подтверждена.
        </p>
    @break

@endswitch
