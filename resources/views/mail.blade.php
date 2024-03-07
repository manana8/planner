    <h1>Hi, {{ $user->name }}!</h1>
    <p>{{ $text }}</p>
    <p>The title of the task is "{{ $task->task->title }}"</p>
    <a href="{{ url('accept-task', $task->id) }}">YES</a>
    <a href="{{ url('decline-task', $task->id) }}">NO</a>
    <p><i>Best wishes {{ $userFrom->name }}</i></p>
    <p><i>Sending Mail from Planner.</i></p>

