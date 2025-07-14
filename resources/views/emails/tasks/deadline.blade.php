<!DOCTYPE html>
<html>
<head>
    <title>Task Deadline Reminder</title>
</head>
<body>
    <h1>Task Deadline Approaching</h1>
    <p>The deadline for the task "{{ $task->title }}" is approaching.</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
    <p>Please ensure the task is completed on time.</p>
</body>
</html>
