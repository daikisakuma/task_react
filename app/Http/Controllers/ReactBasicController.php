<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskReactTodo;

class ReactBasicController extends Controller
{
    /**
     * react_todo画面へ遷移
     *
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function reactTodo()
    {
        return view('task.reactTodo');
    }

    /**
     * todoを登録
     *
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function registerTodo(Request $request)
    {
        TaskReactTodo::registerTodo($request);
        return json_encode(['status' => 1]);
    }

    /**
     * todo取得
     *
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function loadTodo()
    {
        $jsonNewTodo = TaskReactTodo::loadTodo();
        return $jsonNewTodo;
    }

    /**
     * todo削除
     *
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function deleteTodo(Request $request)
    {
        TaskReactTodo::deleteTodo($request);
        return json_encode(['status' => 1]);
    }

    /**
     * todoのステータスを変更
     *
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function statusChangeTodo(Request $request)
    {
        TaskReactTodo::statusChangeTodo($request);
        return json_encode(['status' => 1]);
    }
}
