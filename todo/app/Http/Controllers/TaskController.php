<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        $filePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filePath = $this->saveImage($request->file('image'));
        }

        Task::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'user_id' => \Auth::id(),
            'image_at' => $filePath,
        ]);

        return redirect()->route('task.index');
    }

    public function edit(Task $task)
    {
        if (Gate::denies('access-task', $task)) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task, TaskRequest $request)
    {
        if (Gate::denies('access-task', $task)) {
            abort(403);
        }

        $filePath = $task->image_at;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $filePath = $this->saveImage($request->file('image'));
        }

        $task->update([
            'title' => $request->title,
            'contents' => $request->contents,
            'image_at' => $filePath,
        ]);

        return redirect()->route('task.index');
    }

    public function delete(Task $task)
    {
        // dd($task->image_at);
        Storage::delete('storage/app/public/images/tasks/Gop8B5nn3fQen9epjMYEukej6fx52TLsm5HRWfAr.jpeg');
        dd($task->image_at);

        if (Gate::denies('access-task', $task)) {
            abort(403);
        }

        if (!is_null($task->image_at)) {
            $this->deleteImage($task);
        }

        $task->delete();

        return redirect()->route('task.index');
    }

    public function bookmark(Task $task)
    {
        $task->bookmarks()->attach(\Auth::id());

        return redirect()->route('task.index');
    }

    public function unbook(Task $task)
    {
        $task->bookmarks()->detach(\Auth::id());

        return redirect()->route('task.index');
    }

    public function search(Request $request)
    {
        $searchWord = $request->input('text');
        $tasks = Task::where('title', 'like', "%$searchWord%")
            ->orWhere('contents', 'like', "%$searchWord%")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    private function saveImage($image)
    {
        // php artisan storage:linkコマンドでシンボリックリンクも作成する
        $filePath = $image->store(
            'images/tasks',
            'public'
        );

        return 'storage/' . $filePath;
    }

    private function deleteImage($task)
    {
        Storage::disk('local')->delete('storage/images/tasks/Gop8B5nn3fQen9epjMYEukej6fx52TLsm5HRWfAr.jpeg');
        dd($task->image_at);
    }
}
