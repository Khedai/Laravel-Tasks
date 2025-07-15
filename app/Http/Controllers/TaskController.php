<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->latest()->get();

        $analytics = [
            'dates' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'interactions' => [5, 8, 7, 6, 10, 12, 9],
            'contributors' => ['Gomo', 'Ayabonga', 'Nkanyiso'],
            'contributions' => [12, 9, 5]
        ];

        return view('dashboard', compact('tasks', 'analytics'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
        ]);

        $taskData = $validated;
        if (!Auth::user()->isAdmin()) {
            $taskData['user_id'] = Auth::id();
        }
        $taskData['status'] = 'Pending';
        $taskData['creator_id'] = Auth::id();

        Task::create($taskData);

        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
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


    public function updateStatus(Task $task)
    {
        $task->status = $task->status === 'completed' ? 'pending' : 'completed';
        $task->save();


        return back()->with('success', 'Task status updated!');

    }

    public function destroy(Task $task)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $task->user_id) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted.');
    }


    public function create()
{
    $users = User::all();
    return view('tasks.create', compact('users'));
}

}



