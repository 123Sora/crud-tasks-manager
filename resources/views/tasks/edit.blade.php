@extends('layouts.app')

@section('content')
     <div class="flex items-center mb-4">
        <!-- Heroicon: Pencil Square -->
        <svg class="w-6 h-6 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16.862 3.487a2.5 2.5 0 113.535 3.535L7.5 19.92 3 21l1.08-4.5 12.782-12.782z"/>
        </svg>

        <h1 class="text-2xl font-bold text-gray-800">Edit Task</h1>
    </div>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $task->title }}"
            class="border p-2 rounded w-full mb-2" required>
        <textarea name="description"
            class="border p-2 rounded w-full mb-2">{{ $task->description }}</textarea>

        <label class="inline-flex items-center mb-4">
            <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}>
            <span class="ml-2">Completed</span>
        </label>

        <div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('tasks.index') }}" class="ml-2 text-gray-600 underline">Cancel</a>
        </div>
    </form>
@endsection 
