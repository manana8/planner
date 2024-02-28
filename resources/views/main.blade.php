@extends('layouts')
@section('content')
    <main class="app">
        <nav class="nav">
            <a href="{{ url('main') }}" class="nav__item active">All</a>
            <a href="{{ url('active-tasks') }}" class="nav__item active">Active</a>
            <a href="{{ url('done-tasks') }}" class="nav__item active">Complete</a>
        </nav>
            <a href="{{ 'add-task' }}" >Add task</a>
            <ul class="list">
                @foreach($tasks as $task)
                    <input type="text" placeholder="task_id" name="task_id" hidden="" value="{{ $task->id }}">
                    <a href="{{ url('edit-task', $task->id) }}" >Изменить</a>
                    <a href="{{ url('history', $task->id) }}" class="delete">View the history</a>
                    <p><a href="{{ url('add-comment', $task->id) }}" >Add comments</a>
                    <a href="{{ url('comments', $task->id) }}" >View the comments</a>
                    <li class="item">
{{--                    <form method="POST" class="doneTask" onsubmit="return false">--}}
{{--                        @csrf--}}
                        @if(!$task->data_of_done)
                            <a href="{{ url('done-task', $task->id) }}"><label type="checkbox" class="item__checkbox"></label></a>
                        @else
                            <a href="{{ url('done-task', $task->id) }}"><label type="checkbox" class="item__done"></label></a>
                        @endif
{{--                    </form>--}}
                        {{ $task->title }} <a href="{{ url('delete-task', $task->id) }}" class="delete">Delete</a> </li>
                        <div style="color: #4a5568"><p> Deadline: {{ $task->deadline }} </p></div>
                        <div style="color: teal"><p> Category: {{ $task->category->category }} </p></div>
                        <div class="content" style="color: darkgrey"><p> {{ $task->text }} </p></div>
                        @if($task->data_of_done)
                            <div class="status" style="color: green"><p> Data of done: {{ $task->data_of_done}} </p></div>
                        @else
                            <div class="status" style="color: red">Status: IN PROGRESS</div>
                        @endif
                @endforeach
            </ul>

    </main>

{{--    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>--}}
{{--    <script>--}}
{{--        $("document").ready(function() {--}}
{{--            $('.doneTask').submit(function() {--}}
{{--                $.ajax({--}}
{{--                    type: "POST",--}}
{{--                    url: "/done-task/{{ $task->id }}",--}}
{{--                    data: $(this).serialize(),--}}
{{--                    success: function() {--}}
{{--                        console.log('done');--}}
{{--                        this.classList.toggle('.item__done');--}}
{{--                        // $('input.add__input').val('');--}}
{{--                    }--}}
{{--                })--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <style>
        * {
            font-family: "Hind", sans-serif;
            box-sizing: border-box;
        }

        ::selection {
            background: #00b9a0;
        }

        ::-webkit-input-placeholder {
            color: #e0e0e0;
        }

        ::-moz-placeholder {
            color: #e0e0e0;
        }

        :-ms-input-placeholder {
            color: #e0e0e0;
        }

        :-moz-placeholder {
            color: #e0e0e0;
        }

        body {
            background-image: linear-gradient(to right top, #053037, #005a60, #008984, #00b9a0, #12ebb2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .app {
            background: #ffffff;
            /*width: 500px;*/
            /*margin: 20vh 15px 20vh 15px;*/
            padding: 45px 35px;
            display: flex;
            flex-direction: column;
            box-shadow: 10px 10px 14px 1px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        @media (max-width: 530px) {
            .app {
                max-width: 500px;
            }
        }

        .nav {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }
        .nav__item {
            margin-right: 30px;
            color: #e0e0e0;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.1s;
        }
        .nav__item:hover, .nav__item:focus {
            color: #222222;
            outline: 0;
        }
        .nav__item.active {
            color: #00b9a0;
        }
        .nav__item:last-child {
            margin-right: 0;
        }

        .add__radio--1 .add__circle {
            background: #12ebb2;
        }

        .add__radio--2 .add__circle {
            background: #00b9a0;
        }

        .add__radio--3 .add__circle {
            background: #008984;
        }
        .add__radio input {
            display: none;
        }
        .add__radio input:checked + .add__circle {
            transform: scale(1);
        }

        .list {
            margin-top: 5px;
            padding: 0 20px;
        }

        .item {
            padding: 5px 35px 5px 20px;
            margin-bottom: 20px;
            transition: all 0.1s linear;
            color: #222222;
            font-weight: 500;
            font-size: 16px;
            display: flex;
            align-items: center;
            position: relative;
        }
        .item:last-child {
            margin-bottom: 0;
        }

        .item__checkbox {
            border-radius: 50%;
            width: 20px;
            height: 20px;
            border: 3px dashed red;
            background: transparent;
            margin-right: 10px;
        }
        .item__done {
             border-radius: 50%;
             width: 20px;
             height: 20px;
             /*border: 3px dashed red;*/
             background: green;
            margin-right: 10px;
         }
        .delete {
            margin-left: auto;

        }

        .content {
            border: 2px solid #e0e0e0;
            display: flex;
            justify-content: left;
        }

        .status {
            height: 32px;
            margin-bottom: 20px;
            display: flex;
            justify-content: right;
        }
    </style>
@endsection
