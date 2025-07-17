<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Task Model
 * 
 * Represents a task in the system with its associated properties and relationships.
 * Tasks can be assigned to users, have different priority levels and status states.
 * 
 * @property int $id
 * @property string $title Task title
 * @property string $description Detailed description of the task
 * @property string $status Current status (completed, pending, in progress)
 * @property string $priority Task priority level (high, medium, low)
 * @property int $user_id ID of the user who created the task
 * @property int $assigned_to ID of the user assigned to the task
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'description', 'status', 'priority', 'user_id'];

    /**
     * Get the user who created the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user assigned to complete the task.
     * This may be different from the user who created the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

}
