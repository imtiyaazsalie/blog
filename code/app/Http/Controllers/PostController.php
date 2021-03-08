<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Post[]|Application|Factory|View|Collection|Response
     */
    public function index()
    {
        return view('post.index', ['posts' => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(PostStoreRequest $request)
    {
        $result = Post::create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => $request->user()->id
        ]);

        return redirect('blog/' . $result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View|Response
     */
    public function show(Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View|Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        return redirect('blog/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Post $post)
    {
        if($post->user_id == auth()->user()->id) {
            $post->delete();
        }

        return redirect('/blog');
    }
}
