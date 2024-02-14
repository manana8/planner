@extends('layouts')
@section('content')
    <main class="app">
        <nav class="nav">
            <a href="{{ url('main') }}" class="nav__item active">All</a>
            <a href="{{ url('active-tasks') }}" class="nav__item active">Active</a>
            <a href="{{ url('done-tasks') }}" class="nav__item active">Complete</a>
        </nav>
        <form method="POST" class="addTaskForm" onsubmit="return false" >
            @csrf
            <div class="add">
                <div class="add__priority">
                    <label class="add__radio" title="STUDY">
                        <input checked type="radio" name="category_id" value=1>
                        <span class="add__circle"></span>
                    </label>
                    <label class="add__radio add__radio--1" title="WORK">
                        <input type="radio" name="category_id" value=2>
                        <span class="add__circle"></span>
                    </label>
                    <label class="add__radio add__radio--2" title="SPORT">
                        <input type="radio" name="category_id" value=3>
                        <span class="add__circle"></span>
                    </label>
                    <label class="add__radio add__radio--3" title="REALLY IMPORTANT">
                        <input type="radio" name="category_id" value=4>
                        <span class="add__circle"></span>
                    </label>
                    <label class="add__radio add__radio--3" title="OTHER">
                        <input type="radio" name="category_id" value=5>
                        <span class="add__circle"></span>
                    </label>
                </div>
                <input placeholder="+ Add title" type="text" name="title" class="add__input">
                <input placeholder="+ Add task" type="text" name="text" class="add__input">
                <input type="date" name="deadline" class="add__input">
                <input placeholder="+ Add status" type="text" name="status" class="add__input">
                <button type="submit" class="btn">Add</button>
            </div>
        </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $("document").ready(function() {
            $('.addTaskForm').submit(function() {
                $.ajax({
                    type: "POST",
                    url: "/add-task",
                    data: $(this).serialize(),
                    success: function() {
                        console.log('done');
                        $('input.add__input').val('');
                    }
                })
            });
        });
    </script>

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

        .add {
            margin-bottom: 30px;
            padding: 0 25px;
            color: #222222;
        }
        .add__input {
            width: 100%;
            padding: 5px 20px;
            font-size: 18px;
            border: 0;
            line-height: 1;
            border-bottom: 2px solid #f9f9f9;
            color: #222222;
            transition: all 0.2s ease-in-out;
        }
        .add__input:focus, .add__input:active {
            border-color: #00b9a0;
            outline: 0;
        }
        .add__priority {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .add__circle {
            border-radius: 50%;
            width: 4px;
            height: 4px;
            background: #e0e0e0;
            display: block;
            transition: all 0.15s ease;
            transform: scale(0);
        }
        .add__radio {
            cursor: pointer;
            margin: 0 8px 0 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .add__radio--1 {
            border-color: #12ebb2;
        }
        .add__radio--1 .add__circle {
            background: #12ebb2;
        }
        .add__radio--2 {
            border-color: #00b9a0;
        }
        .add__radio--2 .add__circle {
            background: #00b9a0;
        }
        .add__radio--3 {
            border-color: #008984;
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
        .add__radio:last-child {
            margin: 0;
        }

         .item:hover .item__delete {
            transform: scale(1);
        }
        .item__checkbox input {
            display: none;
        }
        .item__checkbox input:checked + .fa-check {
            transform: scale(1);
        }
    </style>
@endsection
