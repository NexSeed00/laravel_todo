<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

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

    public function store(Request $request)
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

    public function update(int $id, Request $request)
    {
        $task = Task::find($id);

        $task->update([
            'title' => $request->title,
            'contents' => $request->contents,
        ]);

        return redirect()->route('task.index');

    }
}
