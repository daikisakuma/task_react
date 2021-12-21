<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TaskReactTodo extends Model
{
    protected $table = 'task_react_todo';
    protected $fillable = ['user_id', 'todo', 'status', 'task_schedule_at', 'deleted_at'];

    /**
     * todo登録
     *
     * @static
     * @access public
     * @return void
     */
    public static function registerTodo($request) {
        TaskReactTodo::create(['user_id' => Auth::user()->id
                               ,'todo' => $request->todo
                               ,'status' => 1
                               ,'task_schedule_at' => $request->task_schedule_at
        ]);
    }

    /**
     * todo取得
     *
     * @static
     * @access public
     * @return void
     */
    public static function loadTodo() {
        $todo = TaskReactTodo::select('id', 'user_id', 'todo as todoText', 'status', 'task_schedule_at as todoTime', 'deleted_at')
                                ->where('deleted_at', null)
                                ->orderBy('task_schedule_at')
                                ->get();
        $incompleteTodos = [];
        $completeTodos = [];
        foreach ($todo as $todoItem) {
            $todoItem->todoTime = substr($todoItem->todoTime, 0, 16);
            if ($todoItem->status == 1) {
                $incompleteTodos[] = $todoItem;
            } elseif ($todoItem->status == 2) {
                $completeTodos[] = $todoItem;
            }
        };
        $newTodo = ['incompleteTodos' => $incompleteTodos, 'completeTodos' => $completeTodos];
        $jsonNewTodo = json_encode($newTodo);
        return $jsonNewTodo;
    }

    /**
     * todo削除フラグをたてる
     *
     * @static
     * @access public
     * @return void
     */
    public static function deleteTodo($request) {
        $now = date("Y-m-d H:i:s");
        TaskReactTodo::where('id', $request->id)
                     ->update(['deleted_at' => $now]);
    }

    /**
     * todo削除フラグをたてる
     *
     * @static
     * @access public
     * @return void
     */
    public static function statusChangeTodo($request) {
        TaskReactTodo::where('id', $request->id)
                     ->update(['status' => $request->status]);
    }
}
