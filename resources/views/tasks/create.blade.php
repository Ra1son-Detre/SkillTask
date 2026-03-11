@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Создать задачу</h2>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        {{-- Заголовок --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Заголовок</label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Описание --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea id="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      name="description"
                                      rows="4"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Цена --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Цена</label>
                            <input type="number"
                                   class="form-control @error('price') is-invalid @enderror"
                                   id="price"
                                   name="price"
                                   step="0.01"
                                   value="{{ old('price') }}"
                                   required>
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Кнопка --}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Создать задачу</button>
                        </div>

                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('tasks.index') }}">На главную</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
