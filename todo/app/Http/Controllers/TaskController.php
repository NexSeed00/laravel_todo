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
        ]);

        return redirect()->route('task.index');
    }

    public function edit(int $id)
    {
        $task = Task::find($id);

        return view('tasks.edit', compact('task'));
    }

    public function update(int $id, TaskRequest $request)
    {
        $task = Task::find($id);

        $task->update([
            'title' => $request->title,
            'contents' => $request->contents,
        ]);

        return redirect()->route('task.index');
    }

    public function delete(int $id)
    {
        $task = Task::find($id);

        $task->delete();

        return redirect()->route('task.index');
    }
}
