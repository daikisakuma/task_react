<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
