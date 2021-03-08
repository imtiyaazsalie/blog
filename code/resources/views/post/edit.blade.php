@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form id="edit-post" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Post title</label>
                            <input type="text" name="title" value="{{ $post->title }}" class="form-control"
                                   placeholder="Title" id="title" required
                                   data-validation-required-message="Please enter a title.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Body</label>
                            <textarea rows="5" class="form-control" placeholder="Message" id="body" name="body" required
                                      data-validation-required-message="Please enter content.">{{ $post->body }}</textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div class="btn-group" role="group">
                        <a href="/blog" class="btn btn-secondary">Go back</a>
                        <button type="submit" class="btn btn-primary" id="update-post">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
