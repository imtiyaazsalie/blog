@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @forelse($posts as $post)
                <div class="post-preview">
                    <a href="/blog/{{$post->id}}">
                        <h2 class="post-title">
                            {{ ucfirst($post->title) }}
                        </h2>
                        <h3 class="post-subtitle text-truncate">
                            {{ $post->body }}
                        </h3>
                    </a>
                    <p class="post-meta">Posted by
                        <a href="#">{{$post->user->name}}</a>
                        on {{\Carbon\Carbon::createFromTimestamp(strtotime($post->updated_at))->format('j-F-Y')}}</p>
                </div>
                <hr>
            @empty
                <p class="text-warning">No blog Posts available</p>
            @endforelse
            @auth()
                <a href="/blog/create/post" class="btn btn-primary btn-sm">Add Post</a>
            @endauth

        </div>
    </div>
@endsection
