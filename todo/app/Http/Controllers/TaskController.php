<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));

    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        Task::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'user_id' => \Auth::id(),
        ]);

        return redirect()->route('task.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task, TaskRequest $request)
    {
        $task->update([
            'title' => $request->title,
            'contents' => $request->contents,
        ]);

        return redirect()->route('task.index');
    }

    public function delete(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index');
    }
}
