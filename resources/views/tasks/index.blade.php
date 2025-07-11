@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">All Tasks</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">+ Create New Task</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->assignee->name ?? 'Unassigned' }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->deadline ?? '-' }}</td>
                <td>
                    @can('update', $task)
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    @endcan

                    @can('delete', $task)
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
