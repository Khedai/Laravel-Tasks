<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Task-Manager Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap & Chart.js -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background-color: #f5f9fc; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .user-initials { background: #007bff; color: white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: .9rem; }
        .assigned-badge { background: #007bff; color: white; border-radius: 50%; width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; font-size: .8rem; }
        .card { border-radius: .75rem; box-shadow: 0 .25rem .5rem rgba(0,123,255,0.05); position: relative; }
        .priority-badge { position: absolute; bottom: .75rem; right: .75rem; padding: .5rem .75rem; border-radius: 5px; font-weight: bold;  }
        .priority-high { background: #f8d7da; color: #721c24; }
        .priority-medium { background: #fff3cd; color: #856404; }
        .priority-low { background: #d4edda; color: #155724; }
        .nav-tabs .nav-link.active { background: #007bff; color: #fff; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg px-4">
    <span class="navbar-brand fw-bold text-primary">Task-Manager</span>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                <div class="user-initials">{{ strtoupper(auth()->user()->name[0] ?? '?') }}</div>
                <span class="ms-2">{{ strtok(auth()->user()->name, ' ') }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tasks">Tasks</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#analytics">Analytics</button></li>
    <div class="tab-content">
        <!-- Tasks Tab -->
        <div class="tab-pane fade show active" id="tasks">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">+ New Task</button>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($tasks as $task)
                    @php
                        $pm = ['high'=>['HP','priority-high'], 'medium'=>['MP','priority-medium'], 'low'=>['LP','priority-low']];
                        [$plabel,$pclass] = $pm[strtolower($task->priority)];
                    @endphp
                    <div class="col">
                        <div class="card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5>{{ $task->title }}</h5>
                                <span class="assigned-badge" title="{{ $task->user->name ?? 'Unknown' }}">{{ strtoupper(substr($task->user->name ?? '?',0,1)) }}</span>
                            </div>
                            <p class="text-muted">{{ $task->description }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                            <div class="d-flex gap-2">
                                <form method="POST" action="{{ route('tasks.update.status', $task) }}">@csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-success">{{ $task->status==='completed' ? 'Mark Pending' : 'Mark Completed' }}</button>
                                </form>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal-{{ $task->id }}">Edit</button>
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">@csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                            <span class="priority-badge {{ $pclass }}">{{ $plabel }}</span>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editTaskModal-{{ $task->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('tasks.update', $task) }}">
                                @csrf @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header"><h5>Edit Task</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                    <div class="modal-body">
                                        <input name="title" class="form-control mb-2" value="{{ $task->title }}" required>
                                        <textarea name="description" class="form-control mb-2">{{ $task->description }}</textarea>
                                        <select name="priority" class="form-select" required>
                                            <option value="low" {{ $task->priority=='low'?'selected':'' }}>Low</option>
                                            <option value="medium" {{ $task->priority=='medium'?'selected':'' }}>Medium</option>
                                            <option value="high" {{ $task->priority=='high'?'selected':'' }}>High</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Update</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Analytics Tab -->
        <div class="tab-pane fade" id="analytics">
            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="card p-4"><h5>Interactions Per Day</h5><canvas id="interactionsChart"></canvas></div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4"><h5>Top Contributors</h5><canvas id="contributorsChart"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5>New Task</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <input name="title" class="form-control mb-2" placeholder="Title" required>
                    <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
                    <select name="priority" class="form-select" required>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary">Create Task</button></div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const interactions = @json($analytics['interactions']);
    const dates = @json($analytics['dates']);
    const contributors = @json($analytics['contributors']);
    const contributions = @json($analytics['contributions']);

    new Chart(document.getElementById('interactionsChart').getContext('2d'), {
        type: 'bar',
        data: { labels: dates, datasets: [{ label: 'Interactions', data: interactions, backgroundColor: '#4dabf7' }] },
        options: { responsive: true }
    });

    new Chart(document.getElementById('contributorsChart').getContext('2d'), {
        type: 'bar',
        data: { labels: contributors, datasets: [{ label: 'Tasks Completed', data: contributions, backgroundColor: ['#007bff','#5bc0de','#9dd9f3'] }] },
        options: { responsive: true }
    });
</script>
</body>
</html>
