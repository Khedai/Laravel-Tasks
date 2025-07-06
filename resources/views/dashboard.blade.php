<x-bootstrap-app-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </x-slot>

    <div class="row">
        <!-- Sidebar Column (User List) -->
        <div class="col-md-4 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    Team Members
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $user->name }}
                            @if ($user->isAdmin())
                                <span class="badge bg-primary rounded-pill">Admin</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Member</span>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item">No users found.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Main Content Column (Task List) -->
        <div class="col-md-8 col-lg-9">
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

            <!-- Task List Card -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title h4 mb-4">Tasks</h2>
                    <div class="list-group">
                        @php
                            $priorityColors = [
                                'Low' => 'bg-info text-dark',
                                'Medium' => 'bg-warning text-dark',
                                'High' => 'bg-danger',
                            ];
                        @endphp
                        @forelse ($tasks as $task)
                            <div class="list-group-item list-group-item-action">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-1 fw-bold">{{ $task->title }}</h5>
                                        <p class="mb-1 text-muted">{{ $task->description }}</p>
                                        <div class="mt-2">
                                            <span class="badge {{ $priorityColors[$task->priority] ?? 'bg-secondary' }}">{{ $task->priority }} Priority</span>
                                            <span class="badge bg-primary">{{ $task->category }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-md-center">
                                        <p class="mb-1"><small class="fw-bold">Assigned to: {{ $task->user->name ?? 'N/A' }}</small></p>
                                        @if ($task->deadline)
                                            <small class="text-secondary">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end align-items-center">
                                        <!-- Status Update Dropdown and Delete Button... -->
                                        @include('partials.task-actions', ['task' => $task])
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item">
                                <p class="mb-0">No tasks yet! Use the button above to create one.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Create Task Modal (no changes needed here, can stay at the bottom) -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <!-- ... modal content ... -->
        @include('partials.create-task-modal', ['users' => $users])
    </div>
</x-bootstrap-app-layout>