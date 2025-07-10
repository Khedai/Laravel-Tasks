<div class="btn-group" role="group">
    <!-- Status Dropdown -->
    <div class="dropdown me-2">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="statusDropdown-{{ $task->id }}" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $task->status }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="statusDropdown-{{ $task->id }}">
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('update-status-{{ $task->id }}-Pending').submit();">Pending</a></li>
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('update-status-{{ $task->id }}-In_Progress').submit();">In Progress</a></li>
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('update-status-{{ $task->id }}-Completed').submit();">Completed</a></li>
        </ul>
        
        @foreach(['Pending', 'In_Progress', 'Completed'] as $status)
            <form id="update-status-{{ $task->id }}-{{ $status }}" action="{{ route('tasks.update.status', $task) }}" method="POST" class="d-none">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="{{ str_replace('_', ' ', $status) }}">
            </form>
        @endforeach
    </div>

    <!-- Edit Button -->
    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary me-2">
        <i class="fas fa-edit"></i> Edit
    </a>

    <!-- Delete Button -->
    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-trash-alt"></i> Delete
        </button>
    </form>
</div>