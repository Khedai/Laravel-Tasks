<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // In your DashboardController.php or similar

public function index()
{
    // Example tasks array, replace with actual DB queries
    $tasks = [
        [
            'id' => 1,
            'title' => 'Implement user authentication',
            'description' => 'Create login and registration forms with validation',
            'creator' => 'Ayabonga',
            'due_date' => '2025-07-15',
            'completed' => false,
        ],
        [
            'id' => 2,
            'title' => 'Design dashboard mockups',
            'description' => 'Create wireframes and high-fidelity designs for main dashboard',
            'creator' => 'Gomo',
            'due_date' => '2025-07-20',
            'completed' => true,
        ],
        // Add more tasks here...
    ];

    // Analytics example data
    $analytics = [
        'dates' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        'interactions' => [5, 8, 7, 6, 10, 12, 9], // number of interactions per day
        'contributors' => ['Gomo', 'Ayabonga', 'Nkanyiso'],
        'contributions' => [12, 9, 5] // number of tasks completed or interactions
    ];

    return view('dashboard', compact('tasks', 'analytics'));
}

}
