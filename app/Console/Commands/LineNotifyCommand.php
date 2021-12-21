<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TaskReactTodo;

class LineNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:LineNotify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TODOに登録した日時が現在時刻から１０分後以内のときにLINEにTODOの内容を通知する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = date("Y-m-d H:i:s");
        $MinutesLater10 = date("Y-m-d H:i:s", strtotime('10 minutes'));
        $todos = TaskReactTodo::where('deleted_at', null)
                              ->where('status', 1)
                              ->whereBetween('task_schedule_at', [$now, $MinutesLater10])
                              ->orderBy('task_schedule_at')
                              ->get();
        $token = 'a6HVNIaXfeacgGJKWKb6LzTVgug61Bxo76g2JimTUtB';
        foreach ($todos as $todo) {
            $todoText = $todo->todo;
            exec("curl -X POST -H 'Authorization: Bearer $token' -F 'message=$todoText' https://notify-api.line.me/api/notify");
        }
    }
}
