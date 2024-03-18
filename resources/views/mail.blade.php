    <h1>Hi, {{ $user->name }}!</h1>
    <p>{{ $text }}</p>
    <p>The title of the task is "{{ $invitation->task->title }}"</p>
    <a href=http://localhost:81/accept-task/{{ $invitation->id }}>YES</a>
    <a href=http://localhost:81/'decline-task', {{ $invitation->id }}>NO</a>
    <p><i>Best wishes {{ $userFrom->name }}</i></p>
    <p><i>Sending Mail from Planner.</i></p>

