<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use GuzzleHttp\Client;

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
    public function create(Request $request)
    {
        // show books to create a new post
        $data = [];
        $items = null;

        if (!empty($request->keyword))
        {
          // replaced space with '+' and encoded keyword to search
          $title = urlencode(preg_replace('/[\p{Z}\p{Cc}]++/u', '+', $request->keyword));
          // url for Google Books APIs
          $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';
          // get books json
          $client = new Client();
          $response = $client->request("GET", $url);
          $body = $response->getBody();
          $bodyArray = json_decode($body, true);
          // get book info
          $items = $bodyArray['items'];
        }

        $data = [
          'items' => $items,
          'keyword' => $request->keyword,
        ];

        return view('posts.create', $data);
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
        $rules = [
          'book_title' => ['required']
        ];
        $this->validate($request, $rules);

        $post = new Post;
        $post->user_id = Auth::id();
        $post->book_title = $request->book_title;
        $post->book_author = $request->book_author;
        $post->save();
        // return redirect('/posts/'.$post->id);
        return view('posts.edit', ['post' => $post]);
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
        if(Auth::id() == $post->user_id){
          return view('posts.edit', ['post' => $post]);
        }else{
          return redirect('/');
        }
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

        $rules = [
          'book_title' => ['required']
        ];
        $this->validate($request, $rules);

        if(Auth::id() == $post->user_id){
          $post->book_title = $request->book_title;
          $post->book_author = $request->book_author;
          $post->note = $request->note;
          $post->plan = $request->plan;
          $post->result = $request->result;
          $post->save();
        }
        return redirect('/posts/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete a post
        $post = Post::find($id);
        if(Auth::id() == $post->user_id) $post->delete();
        return redirect('/');
    }
}
