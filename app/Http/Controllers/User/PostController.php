<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = auth()->user()->posts()->paginate(15);

        return view('user.post.index', compact('posts'));
    }

    public function formStore()
    {
        return view('user.post.store');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $request->image;
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category_id;

        auth()->user()->posts()->save($post);
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        $post = auth()->user()->posts()->find($id);

        $post->fill($request->all())->save();
    }
    
    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);

        $post->delete();
    }
}
