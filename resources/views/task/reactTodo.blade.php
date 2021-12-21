@extends('layouts.taskapp')

@section('content')
<link href="{{ asset('css/reactTodo.css') }}" rel="stylesheet">
    <div class="task1">
        <div
            id="react-todo"
            data-register-todo={{ route('register.todo') }}
            data-load-todo={{ route('load.todo') }}
            data-delete-todo={{ route('delete.todo') }}
            data-status-change-todo={{ route('status.change.todo') }}
            data-images-alarm={{ asset('images/todo_alarm.png') }}
        ></div>
    </div>
@endsection
