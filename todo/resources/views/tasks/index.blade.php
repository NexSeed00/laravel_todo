@extends('layouts.app')

@section('content')
    <div class="row p-3">
        @foreach($tasks as $task)
            <div class="col-sm-6 col-md-4 col-lg-3 py-3 py-3">
                <div class="card">
                    <img src="{{ asset($task->image_at) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text">
                            {{ $task->contents }}
                        </p>
                        <div class="text-right d-flex justify-content-end">
                            @auth
                                @if (false)
                                    <form action="{{ route('task.bookmark', ['task' => $task->id]) }}" method="post">
                                        @csrf
                                        <button class="btn text-info">
                                            <i class="far fa-star text-warning"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('task.unbook', ['task' => $task->id]) }}" method="post">
                                        @csrf
                                        <button class="btn text-info">
                                            <i class="fas fa-star text-warning"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            @can('access-task', $task)
                                <a href="{{ route('task.edit', ['task' => $task->id]) }}" class="btn text-success">EDIT</a>
                                <form action="{{ route('task.delete', ['task' => $task->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn text-danger">DELETE</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
