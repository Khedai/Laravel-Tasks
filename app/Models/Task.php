<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'priority', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignee()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

}
