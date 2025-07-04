<x-bootstrap-app-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">My Tasks</h1>
    </x-slot>

    <!-- Success Message Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Button to trigger the modal -->
    <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">
            Create New Task
        </button>
    </div>

    <!-- Task List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title h4 mb-4">Your Tasks</h2>
            <div class="list-group">
                @forelse ($tasks as $task)
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <h5 class="mb-1 fw-bold">{{ $task->title }}</h5>
                                <p class="mb-1 text-muted">{{ $task->description }}</p>
                                @if ($task->deadline)
                                    <small class="text-secondary">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</small>
                                @endif
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <span class="badge rounded-pill mb-2 {{ $task->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                                <div class="btn-group" role="group">
                                    @if ($task->status == 'pending')
                                        <!-- Mark as Complete Button -->
                                        <form method="POST" action="{{ route('tasks.update', $task) }}" class="me-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Complete</button>
                                        </form>
                                    @endif
                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item">
                        <p class="mb-0">You have no tasks yet! Use the button above to create one.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createTaskModalLabel">Create a New Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="modal-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <!-- Deadline -->
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline (Optional)</label>
                            <input type="date" class="form-control" name="deadline" id="deadline">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-bootstrap-app-layout>