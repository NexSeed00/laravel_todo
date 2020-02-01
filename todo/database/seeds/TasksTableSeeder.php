<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'title' => 'テストタイトル1',
                'contents'  => 'テスト詳細1',
                'user_id' => 1,
                'image_at' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title' => 'テストタイトル2',
                'contents'  => 'テスト詳細2',
                'user_id' => 1,
                'image_at' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title' => 'テストタイトル3',
                'contents'  => 'テスト詳細3',
                'user_id' => 1,
                'image_at' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        \DB::table('tasks')->delete();

        foreach ($tasks as  $task) {
            \DB::table('tasks')->insert([
                'title' => $task['title'],
                'contents' => $task['contents'],
                'user_id' => $task['user_id'],
                'image_at' => $task['image_at'],
                'created_at' => $task['created_at'],
                'updated_at' => $task['updated_at'],
            ]);
        }
    }
}
