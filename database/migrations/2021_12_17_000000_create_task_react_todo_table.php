<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskReactTodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE `task_react_todo` (
                `id` int(11) unsigned not null auto_increment comment 'ID'
               ,`user_id` int(11) unsigned not null comment 'ユーザーID'
               ,`todo` varchar(255) not null comment 'TODO内容'
               ,`status` int(11) not null comment 'TODOの状態（１の場合未完了のTODO、２の場合完了）'
               ,`task_schedule_at` datetime default null comment 'タスク開始予定日時'
               ,`deleted_at` datetime default null comment '削除日時 兼 削除フラグ'
               ,`updated_at` datetime default null comment '最終更新日時'
               ,`created_at` datetime not null comment 'データ生成日時'
               ,primary key (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            comment = 'ReactタスクのTODOデータ'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        die(__FILE__);
        DB::statement('drop table if exists task_react_todo');
    }
}
