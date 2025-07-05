<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     */
    public function index()
    {
        // Get the logged-in user's tasks, ordered by the newest first
        $tasks = Auth::user()->tasks()->latest()->get();

        // Pass the tasks to the dashboard view
        return view('dashboard', ['tasks' => $tasks]);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        // Create the task and associate it with the logged-in user
        Auth::user()->tasks()->create($validated);

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    /**
     * Update the specified task's status.
     */
    public function update(Task $task)
    {
        // Authorization: Make sure the logged-in user owns this task
        if (Auth::id() !== $task->user_id) {
            abort(403); // Forbidden
        }

        $task->update(['status' => 'completed']);

        return redirect()->route('dashboard')->with('success', 'Task marked as completed!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        // Authorization: Make sure the logged-in user owns this task
        if (Auth::id() !== $task->user_id) {
            abort(403); // Forbidden
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }
}
