<!-- Status Update Dropdown -->
<div class="dropdown me-2">
    <button class="btn btn-sm dropdown-toggle 
        @if($task->status == 'Completed') btn-success
        @elseif($task->status == 'In Progress') btn-info text-dark
        @else btn-secondary @endif" 
        type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $task->status }}
    </button>
    <ul class="dropdown-menu">
        <li><form method="POST" action="{{ route('tasks.update.status', $task) }}" class="px-2"> @csrf @method('PATCH') <input type="hidden" name="status" value="Pending"><button type="submit" class="dropdown-item">Pending</button></form></li>
        <li><form method="POST" action="{{ route('tasks.update.status', $task) }}" class="px-2"> @csrf @method('PATCH') <input type="hidden" name="status" value="In Progress"><button type="submit" class="dropdown-item">In Progress</button></form></li>
        <li><form method="POST" action="{{ route('tasks.update.status', $task) }}" class="px-2"> @csrf @method('PATCH') <input type="hidden" name="status" value="Completed"><button type="submit" class="dropdown-item">Completed</button></form></li>
    </ul>
</div>

<!-- Delete Button -->
<form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
</form>
