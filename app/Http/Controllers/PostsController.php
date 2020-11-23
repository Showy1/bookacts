<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    public function index(Request $request)
    {
        // show posts index

        // $posts = Post::all();
        // return view('index', ['posts' => $posts]);

        $keyword = $request->input('keyword');

        $query = Post::query();

        if (!empty($keyword)) {
            $query->where('book_title', 'LIKE', "%{$keyword}%")
                ->orWhere('book_author', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->orderBy('id', 'desc')->get();

        return view('index', compact('posts', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // show form to create a new post
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save a new post
        $post = new Post;
        $post->user_id = Auth::id();
        $post->book_title = $request->book_title;
        $post->book_author = $request->book_author;
        $post->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // show a post
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // edit a post
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // save an edited post
        $post = Post::find($id);
        $post->book_title = $request->book_title;
        $post->book_author = $request->book_author;
        $post->save();
        return redirect("/posts/".$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        return redirect('/');
    }
}
