import React from "react";

const style = {
    display: 'flex',
    backgroundColor: '#c1ffff',
    width: '1000px',
    height: '50px',
    padding: '8px',
    margin: '8px',
    borderRadius: '8px',
}

export const InputTodo = (props) => {
    const { todoText, onChangeTodoText, todoTime, onChangeTodoTime, onClickAdd, disabled, todoImageAlarm } = props;
    return (
        <div style={style}>
            <img src={todoImageAlarm} alt="" />
            <input
                className="input-area-left"
                type="datetime-local"
                value={todoTime}
                onChange={onChangeTodoTime}
            />
            <input
                className="input-area-right"
                disabled={disabled}
                placeholder="TODOを入力"
                value={todoText}
                onChange={onChangeTodoText}
            />

            <button
            className="input-area-btn"
                disabled={disabled}
                onClick={onClickAdd}>
                追加
            </button>
        </div>
    )
};
