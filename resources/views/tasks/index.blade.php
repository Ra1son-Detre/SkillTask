@extends('layouts.app')
@section('content')
    @include('partials._task-sections')


    <h1 class="mb-4">Мои задачи: </h1>

    <div class="row">

        @foreach($tasks as $task)
            <div class="col-12 col-md-6 col-lg-4 mb-4">

                <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none text-dark">
                    <div class="card p-3 h-100 shadow-sm card-hover">
                        <h5>{{ $task->title }}</h5>
                        <p class="mb-0">{{ $task->price }}  ₽</p>
                        <p class="mb-0">{{ $task->status->label()}} {{$task->status->emoji()}}  </p>
                    </div>
                </a>

            </div>
        @endforeach

    </div>
</div>
@endsection

