import React, { useState, useEffect } from "react";
import { InputTodo } from "./components/InputTodo"
import { IncompleteTodos } from "./components/IncompleteTodos"
import { CompleteTodos } from "./components/CompleteTodos"

export const App = () => {
  const [todoText, setTodoText] = useState('');
  const [todoTime, setTodoTime] = useState('');
  const [incompleteTodos, setIncompleteTodos] = useState([]);
  const [completeTodos, setCompleteTodos] = useState([]);

//todoをデータベースから取得
  const loadTodo = () => {
    var self = this;
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url      : $('#react-todo').data('load-todo')
       ,dataType : 'json'
       ,cache    : false
       ,success  : function(objResponseJSON) {
            setIncompleteTodos(objResponseJSON.incompleteTodos);
            setCompleteTodos(objResponseJSON.completeTodos);
        }
        ,error:       (xhr, objResponseJSON, err) => {
            if (xhr.status === 419) {
                alert('フォームが有効期限切れです。ページを再読み込みしてください。');
            }
        }
    });
  }

//todoをデータベースに保存
  const registerTodo = () => {
    const data = {
        'todo'            : todoText
       ,'task_schedule_at': replaceTodoTime
    }
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url     : $('#react-todo').data('register-todo')
       ,type    : 'post'
       ,data    : data
       ,dataType: 'json'
       ,cache   : false
       ,success : function(objResponseJSON) {
            console.log('登録完了')
            loadTodo();
        }
        ,error:       (xhr, objResponseJSON, err) => {
            if (xhr.status === 419) {
                alert('フォームが有効期限切れです。ページを再読み込みしてください。');
            }
        }
    });
  }

//todoを削除
  const deleteTodo = (id) => {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url     : $('#react-todo').data('delete-todo')
       ,type    : 'post'
       ,data    : {'id': id}
       ,dataType: 'json'
       ,cache   : false
       ,success : function(objResponseJSON) {
            console.log('削除完了')
        }
        ,error:       (xhr, objResponseJSON, err) => {
            if (xhr.status === 419) {
                alert('フォームが有効期限切れです。ページを再読み込みしてください。');
            }
        }
    });
  }

//todoのステータスを変更
  const statusChangeTodo = (id, status) => {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url     : $('#react-todo').data('status-change-todo')
       ,type    : 'post'
       ,data    : {'id': id, 'status': status}
       ,dataType: 'json'
       ,cache   : false
       ,success : function(objResponseJSON) {
            console.log('ステータス変更完了')
        }
        ,error:       (xhr, objResponseJSON, err) => {
            if (xhr.status === 419) {
                alert('フォームが有効期限切れです。ページを再読み込みしてください。');
            }
        }
    });
  }

//日にちと時間の間の「T」を空白に変換
  let replaceTodoTime = todoTime;
  if (todoTime) {
    replaceTodoTime = todoTime.replace('T', ' ');
  }

//Todoの内容と開始予定時刻を配列化
  const todos = {'todoText': todoText, 'todoTime': replaceTodoTime};

//開始予定時刻の若い順に並び替え
  incompleteTodos.sort( ( a , b ) => a.todoTime > b.todoTime ? 1 : -1);
  completeTodos.sort( ( a , b ) => a.todoTime > b.todoTime ? 1 : -1);

//Todoの内容が入力されたらstateに更新
  const onChangeTodoText = (event) => {
    setTodoText(event.target.value);
  }

//Todoの開始予定時刻が入力されたらstateに更新
  const onChangeTodoTime = (event) => {
    setTodoTime(event.target.value);
  }

//Todoの追加ボタンが押されたとき処理
  const onClickAdd = () => {
    if (todoText === "" || todoTime === "") return;
        registerTodo();
        // const newTodos = [...incompleteTodos, todos];
        // setIncompleteTodos(newTodos);
        setTodoText('');
        setTodoTime('');
  };

//Todoの削除ボタンが押されたときの処理
  const onClickDelete = (index) => {
    const newTodos = [...incompleteTodos];
    deleteTodo(newTodos[index].id);
    newTodos.splice(index, 1);
    setIncompleteTodos(newTodos);
  };

//Todoの完了ボタンが押されたときの処理
  const onClickComplete = (index) => {
    const newInCompleteTodos = [...incompleteTodos];
    statusChangeTodo(newInCompleteTodos[index].id, 2);
    newInCompleteTodos.splice(index, 1);

    const newCompleteTodos = [...completeTodos, incompleteTodos[index]];
    setIncompleteTodos(newInCompleteTodos);
    setCompleteTodos(newCompleteTodos);
  };

//Todoの戻すボタンが押されたときの処理
  const onClickBack = (index) => {
    const newCompleteTodos = [...completeTodos];
    statusChangeTodo(newCompleteTodos[index].id, 1);
    newCompleteTodos.splice(index, 1);

    const newInCompleteTodos = [...incompleteTodos, completeTodos[index]];
    setCompleteTodos(newCompleteTodos);
    setIncompleteTodos(newInCompleteTodos);
  };

  useEffect(() => {
    loadTodo();
  }, []);

  let todo_image_alarm = $('#react-todo').data('images-alarm')

  return (
    <div className="main">
      <InputTodo
        todoText={todoText}
        onChangeTodoText={onChangeTodoText}
        todoTime={todoTime}
        onChangeTodoTime={onChangeTodoTime}
        onClickAdd={onClickAdd}
        todoImageAlarm={todo_image_alarm}
        // disabled={incompleteTodos.length >= 5}
      />
      {/* {incompleteTodos.length >= 5 && <p style={{ color: 'red' }} >登録できるtodo5個までだよ～。消化しろ～。</p>} */}
      <IncompleteTodos
        todos={incompleteTodos}
        onClickComplete={onClickComplete}
        onClickDelete={onClickDelete}
        todoImageAlarm={todo_image_alarm}
      />
      <CompleteTodos
        todos={completeTodos}
        onClickBack={onClickBack}
        todoImageAlarm={todo_image_alarm}
      />
    </div>
  );
};
