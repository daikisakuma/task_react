@extends('layouts.taskapp')

@section('content')
<style>
body {
font-family: sans-serif;
}
input {
    border-radius: 16px;
    border: none;
    padding: 6px 16px;
    outline: none;
}
button {
    border-radius: 16px;
    border: none;
    padding: 4px 16px;
}
button:hover {
    background-color: #ff7fff;
    color: #fff;
    cursor: pointer;
}
li {
    margin-right: 8px;
}
.incomplete-area {
    background-color: #c6ffe2;
    width: 400px;
    min-height: 200px;
    padding: 8px;
    margin: 8px;
    border-radius: 8px;
}
.complete-area {
    background-color: #ffffe0;
    width: 400px;
    min-height: 200px;
    padding: 8px;
    margin: 8px;
    border-radius: 8px;
}
.title {
    text-align: center;
    margin-top: 0;
    font-weight: bold;
    color: #666;
}
.list-row {
    display: flex;
    align-items: center;
    padding-bottom: 4px;
}
</style>
    <div class="task1">
        <div id="react-todo"></div>
    </div>
@endsection
