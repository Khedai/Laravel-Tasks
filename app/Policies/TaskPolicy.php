<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->assigned_to;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->assigned_to;
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->assigned_to;
    }