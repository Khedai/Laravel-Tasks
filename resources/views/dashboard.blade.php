<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Create Task Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Create New Task</h3>
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description (Optional):</label>
                            <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                        <!-- Deadline -->
                        <div class="mb-4">
                            <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2">Deadline (Optional):</label>
                            <input type="date" name="deadline" id="deadline" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <!-- Submit Button -->
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Add Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Task List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Your Tasks</h3>
                    <ul>
                        @forelse ($tasks as $task)
                            <li class="mb-4 p-4 border rounded-lg flex justify-between items-center {{ $task->status == 'completed' ? 'bg-green-50' : '' }}">
                                <div>
                                    <h4 class="font-bold text-lg">{{ $task->title }}</h4>
                                    <p class="text-gray-600">{{ $task->description }}</p>
                                    @if ($task->deadline)
                                        <p class="text-sm text-gray-500">Deadline: {{ $task->deadline->format('M d, Y') }}</p>
                                    @endif
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ $task->status == 'completed' ? 'text-green-600 bg-green-200' : 'text-yellow-600 bg-yellow-200' }}">
                                        {{ $task->status }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    @if ($task->status == 'pending')
                                        <!-- Mark as Complete Button -->
                                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">Complete</button>
                                        </form>
                                    @endif
                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <p>You have no tasks yet!</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>