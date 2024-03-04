@extends('layouts')
@section('content')
    <main class="app">
        <b style="margin-left: 500px"> HISTORY</b>
        <hr>
        <ul class="list">
        @for($i=0; $i<count($taskHistories); $i++)
            @if($taskHistories[$i]->type === 'CREATE')
                <p><u> Task creation date: {{$taskHistories[$i]->data_of_history_create}} </u></p>
                    <hr>
            @elseif($taskHistories[$i]->type === 'CHANGE')
                <p><u> Task changing date: {{ $taskHistories[$i]->data_of_history_create }}</u></p>
                @if($taskHistories[$i]->title_before !== $taskHistories[$i-1]->title_before)
                    <p><div style="font-size: 20px"> Title changed from {{ $taskHistories[$i-1]->title_before }} to {{ $taskHistories[$i]->title_before }}</div></p>
                @endif
                @if($taskHistories[$i]->category->category !== $taskHistories[$i-1]->category->category)
                    <p><div style="font-size: 20px"> Category changed from {{ $taskHistories[$i-1]->category->category }} to {{ $taskHistories[$i]->category->category }}</div></p>
                @endif
                @if($taskHistories[$i]->text_before !== $taskHistories[$i-1]->text_before)
                    <p><div style="font-size: 20px"> Content changed from {{ $taskHistories[$i-1]->text_before }} to {{ $taskHistories[$i]->text_before }}</div></p>
                @endif
                @if($taskHistories[$i]->deadline_before!== $taskHistories[$i-1]->deadline_before)
                    <p><div style="font-size: 20px"> Deadline changed from {{ $taskHistories[$i-1]->deadline_before }} to {{ $taskHistories[$i]->deadline_before }} </div></p>
                @endif
                @if($taskHistories[$i]->status_before!== $taskHistories[$i-1]->status_before)
                    <p><div style="font-size: 20px"> Status changed from {{ $taskHistories[$i-1]->status_before }} to {{ $taskHistories[$i]->status_before }} </div></p>
                @endif
            @elseif($taskHistories[$i]->type === 'Done')
                <p><u> Task completion date: {{$taskHistories[$i]->data_of_history_create}} </u></p>
                    <hr>
             @endif
        @endfor
            <input type="button" onclick="history.back();" value="BACK">
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
