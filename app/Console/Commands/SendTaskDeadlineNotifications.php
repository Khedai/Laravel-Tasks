<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Mail\TaskDeadlineNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendTaskDeadlineNotifications extends Command
{
    protected $signature = 'tasks:send-deadline-notifications';
    protected $description = 'Send email notifications to users for tasks nearing their deadline';

    public function handle()
    {
        $now = Carbon::now();
        $soon = $now->copy()->addDay(); // 1 day before deadline

        $tasks = Task::whereNull('notification_sent_at')
            ->where('deadline', '<=', $soon)
            ->where('deadline', '>=', $now)
            ->with('user')
            ->get();

        foreach ($tasks as $task) {
            if ($task->user && $task->user->email) {
                Mail::to($task->user->email)->send(new TaskDeadlineNotification($task));
                $task->notification_sent_at = Carbon::now();
                $task->save();
            }
        }

        $this->info('Task deadline notifications sent.');
    }
}
