@extends('layouts.app')

@section('content')
    <div class="row mt-4 px-4">
        <div class="col-12">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="contents">Contents</label>
                    <textarea class="form-control" name="contents" id="contents" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">POST</button>
                </div>
            </form>
        </div>
    </div>
@endsection
