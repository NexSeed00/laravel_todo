@extends('layouts.app')

@section('content')
    <div class="row p-3">
        @foreach($tasks as $task)
            <div class="col-sm-6 col-md-4 col-lg-3 py-3 py-3">
                <div class="card">
                    <img src="https://picsum.photos/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $task->title; ?></h5>
                        <p class="card-text">
                            <?= $task->contents; ?>
                        </p>
                        <div class="text-right d-flex justify-content-end">
                        <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn text-success">EDIT</a>
                            <form action="" action="post">
                                <input type="hidden" name="id" value="<?= $task->id; ?>">
                                <button type="submit" class="btn text-danger">DELETE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
