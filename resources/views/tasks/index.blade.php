@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tasks</h1>

    @if(session('success'))
        <div class="bg-green-200 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST" class="mb-6">
        @csrf
        <input type="text" name="title" placeholder="Task title"
            class="border p-2 rounded w-full mb-2" required>
        <textarea name="description" placeholder="Task description"
            class="border p-2 rounded w-full mb-2"></textarea>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Add Task</button>
    </form>

    @foreach($tasks as $task)
        {{-- <div class="bg-white p-4 rounded shadow mb-3">
            <h2 class="text-lg font-semibold">{{ $task->title }}</h2>
            <p>{{ $task->description }}</p>

            <div class="mt-2 flex space-x-2">
                <!-- Edit Button with Icon -->
                <a href="{{ route('tasks.edit', $task) }}"
                   class="flex items-center bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.232 5.232l3.536 3.536M9 11l6.364-6.364a2 2 0 112.828 2.828L11.828 14H9v-2.828z"/>
                    </svg>
                    Edit
                </a>

                <!-- Delete Button with Icon -->
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      onsubmit="return confirm('Delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button class="flex items-center bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div> --}}

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-1 {{ $task->completed ? 'line-through text-gray-500' : 'text-gray-900' }}">
                        {{ $task->title }}
                    </h2>
                    <p class="text-gray-600 text-sm {{ $task->completed ? 'line-through text-gray-400' : '' }}">
                        {{ $task->description }}
                    </p>
                </div>

                {{-- Mark as Completed --}}
                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="text-xs sm:text-sm px-3 py-1 rounded-full font-medium 
                                {{ $task->completed ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-300 hover:bg-gray-400' }} 
                                text-white transition duration-200">
                        {{ $task->completed ? '✓ Completed' : '✔ Mark Done' }}
                    </button>
                </form>
            </div>

            <div class="mt-4 flex flex-wrap gap-2">
                {{-- Edit --}}
                <a href="{{ route('tasks.edit', $task) }}" 
                class="inline-flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1.5 text-sm rounded-full transition">
                    ✏️ Edit
                </a>

                {{-- Delete --}}
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" 
                    onsubmit="return confirm('Delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 text-sm rounded-full transition">
                        ❌ Delete
                    </button>
                </form>
            </div>
        </div>       
    @endforeach
@endsection
