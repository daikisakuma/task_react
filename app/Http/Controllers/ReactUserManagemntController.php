<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReactUserManagemntController extends Controller
{
    /**
     * react_user_management画面へ遷移
     *
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function reactUserManagement()
    {
        return view('task.reactUserManagement');
    }
}
