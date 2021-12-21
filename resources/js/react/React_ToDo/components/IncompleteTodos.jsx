import React from "react";

export const IncompleteTodos = (props) => {
    const {todos, onClickComplete, onClickDelete} = props;
    return (
        <div className="incomplete-area">
            <p className="title">未完了のTODO</p>
            <ul>
                {todos.map((todo, index) => {
                    return(
                    <div key={todo.id} className="list-row">
                        <li className="todo-list" id={todo.id}>
                            <span className="list-circle"></span>
                            <div className="todo-time">{todo.todoTime}</div>
                            <div className="todo-text">{todo.todoText}</div>
                        </li>
                        <button style={{ marginRight: '2px' }} onClick={() => onClickComplete(index)}>完了</button>
                        <button onClick={() => onClickDelete(index)}>削除</button>
                    </div>
                    );
                })}
            </ul>
        </div>
    )
}