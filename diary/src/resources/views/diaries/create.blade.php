<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>新規投稿画面</title>
</head>
<body>
    <section class="container m-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route('diary.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">本文</label>
                        <textarea class="form-control" name="body" id="body">{{ old('body') }}</textarea>
                        @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
