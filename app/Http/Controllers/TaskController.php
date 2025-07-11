<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:user,id',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'assigned_to' => $request->assigned_to,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }



    public function update(Request $request, Task $task)
    {

        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($request->only('title', 'description', 'priority'));

        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }

    public function updateStatus(Task $task)
    {
        $task->status = $task->status === 'completed' ? 'pending' : 'completed';
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task status updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted.');
    }

    public function create()
{
    $users = User::all();
    return view('tasks.create', compact('users'));
}

}
