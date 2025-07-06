<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        $tasks = Auth::user()->isAdmin() 
            ? Task::with('user')->latest()->get()
            : Task::where('user_id', Auth::id())->latest()->get();

        $users = User::orderBy('name')->get();

        return view('dashboard', [
            'tasks' => $tasks,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create', [
            'users' => User::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'user_id' => [
                Rule::requiredIf(Auth::user()->isAdmin()),
                'exists:users,id'
            ],
            'priority' => 'required|in:Low,Medium,High',
        ]);

        $taskData = $validated;
        if (!Auth::user()->isAdmin()) {
            $taskData['user_id'] = Auth::id();
        }
        $taskData['status'] = 'Pending';
        $taskData['creator_id'] = Auth::id();

        Task::create($taskData);

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $task->user_id) {
            abort(403);
        }

        return view('tasks.edit', [
            'task' => $task,
            'users' => User::orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $task->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'user_id' => [
                Rule::requiredIf(Auth::user()->isAdmin()),
                'exists:users,id'
            ],
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $task->update($validated);

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    /**
     * Update the specified task's status.
     */
    public function updateStatus(Request $request, Task $task)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $task->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $task->update(['status' => $validated['status']]);

        return back()->with('success', 'Task status updated!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $task->user_id) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }
}