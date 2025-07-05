<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     */
    public function index()
    {
        // Fetch all tasks, eager-loading the assigned user's name
        $tasks = Task::with('user')->latest()->get();

        // Fetch all users to populate the "assign to" dropdown for admins
        $users = User::orderBy('name')->get();

        // Pass tasks AND users to the dashboard view
        return view('dashboard', [
            'tasks' => $tasks,
            'users' => $users
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
            // 'user_id' is only required if the person submitting is an admin
            'user_id' => 'required_if:Auth::user()->isAdmin(),true|exists:users,id'
        ]);

        // If the logged-in user is an admin, they can assign the task to anyone.
        // Otherwise, the task is assigned to the logged-in user.
        $taskData = $validated;
        if (!Auth::user()->isAdmin()) {
            $taskData['user_id'] = Auth::id();
        }

        Task::create($taskData);

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    /**
     * Update the specified task's status.
     */
    public function update(Task $task)
    {
        // Authorization: Admin can update any task.
        // A team member can only update their own tasks.
        if (!Auth::user()->isAdmin() && Auth::id() !== $task->user_id) {
            abort(403);
        }

        $task->update(['status' => 'completed']);
        return redirect()->route('dashboard')->with('success', 'Task marked as completed!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        // Authorization: Admin can delete any task.
        // A team member can only delete their own tasks.
        if (!Auth::user()->isAdmin() && Auth::id() !== $task->user_id) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }
}
