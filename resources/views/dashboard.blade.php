<x-bootstrap-app-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800"> Tasks</h1>
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
            + New Task
        </button>
    </div>

    <!-- Task List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title h4 mb-4">Tasks</h2>
            <div class="list-group">
                @forelse ($tasks as $task)
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <h5 class="mb-1 fw-bold">{{ $task->title }}</h5>
                                <p class="mb-1 text-muted">{{ $task->description }}</p>
                                <div class="mb-1">
                                    <span class="badge bg-secondary me-1">Category: {{ $task->category }}</span>
                                    <span class="badge me-1
                                        @if($task->priority == 'High') bg-danger
                                        @elseif($task->priority == 'Medium') bg-warning text-dark
                                        @else bg-success
                                        @endif
                                    ">Priority: {{ $task->priority }}</span>
                                    <span class="badge bg-info text-dark">Status: {{ $task->status }}</span>
                                </div>
                                <p class="mb-1">
                                    <small class="fw-bold">Assigned to: {{ $task->user->name ?? 'N/A' }}</small>
                                </p>
                                @if ($task->deadline)
                                    <small class="text-secondary">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</small>
                                @endif
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <!-- Status Update Dropdown (Admins & Assignees) -->
                                @if (Auth::user()->isAdmin() || Auth::id() === $task->user_id)
                                    <form method="POST" action="{{ route('tasks.update.status', $task) }}" class="mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm mb-1" onchange="this.form.submit()">
                                            <option value="Pending" @if($task->status == 'Pending') selected @endif>Pending</option>
                                            <option value="In Progress" @if($task->status == 'In Progress') selected @endif>In Progress</option>
                                            <option value="Completed" @if($task->status == 'Completed') selected @endif>Completed</option>
                                        </select>
                                    </form>
                                @else
                                    <span class="badge rounded-pill mb-2
                                        @if($task->status == 'Completed') bg-success
                                        @elseif($task->status == 'In Progress') bg-primary
                                        @else bg-warning text-dark
                                        @endif
                                    ">
                                        {{ $task->status }}
                                    </span>
                                @endif
                                <div class="btn-group" role="group">
                                    <!-- Delete Button (Admins or Assignee) -->
                                    @if (Auth::user()->isAdmin() || Auth::id() === $task->user_id)
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    @endif
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
                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category" id="category" required>
                                <option value="" disabled selected>Select a Category</option>
                                <option value="Work">Work</option>
                                <option value="Personal">Personal</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <!-- Priority -->
                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-select" name="priority" id="priority" required>
                                <option value="" disabled selected>Select Priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        @if (Auth::user()->isAdmin())
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Assign To</label>
                                <select class="form-select" name="user_id" id="user_id" required>
                                    <option value="" disabled selected>Select a Team Member</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
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