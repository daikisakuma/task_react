import React from "react";

export const CompleteTodos = (props) => {
    const { todos, onClickBack } = props;
    return (
        <div className="complete-area">
            <p className="title">完了のTODO</p>
            <ul>
                {todos.map((todo, index) => {
                    return (
                    <div key={todo.todoText} className="list-row">
                        <li className="todo-list">
                            <span className="list-circle"></span>
                            <div className="todo-time">{todo.todoTime}</div>
                            <div className="todo-text">{todo.todoText}</div>
                        </li>
                        <button onClick={() => onClickBack(index)}>戻す</button>
                    </div>
                    );
                })}
            </ul>
        </div>
    )
}
