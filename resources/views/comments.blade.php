@extends('layouts')
@section('content')
    <main class="app">
        <b style="margin-left: 500px"> Comments</b>
        <hr>
        <ul class="list">
        @foreach($taskComments as $taskComment)
            Data: {{ $taskComment->created_at }} <a href="{{ url('delete-comment', $taskComment->id) }}" class="delete">Delete</a>
            <p><u> Comment: {{$taskComment->comment}} </u></p>
            <hr>
        @endforeach
            <a href="{{ url('main') }}"> BACK </a>
        </ul>
    </main>

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
        .item__checkbox input {
            display: none;
        }
        .item__checkbox input:checked + .fa-check {
            transform: scale(1);
        }
    </style>
@endsection
