@extends('layouts.app')

@section('content')
    <h1>マイページ</h1>
    <div class="row p-3">
        @foreach($user->tasks as $task)
            <div class="col-sm-6 col-md-4 col-lg-3 py-3 py-3">
                <div class="card">
                    <img src="{{ asset($task->image_at) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text">
                            {{ $task->contents }}
                        </p>
                        @can('access-task', $task)
                            <div class="text-right d-flex justify-content-end">
                                <a href="{{ route('task.edit', ['task' => $task->id]) }}" class="btn text-success">EDIT</a>
                                <form action="{{ route('task.delete', ['task' => $task->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn text-danger">DELETE</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
