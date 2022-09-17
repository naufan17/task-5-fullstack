<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Post;

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
        $posts = auth()->user()->posts()->orderBy('created_at', 'desc')->paginate(15);

        return view('user.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('user.post.store', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $file = $request->file('image');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('image', $nama_file);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $nama_file;
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category_id;

        auth()->user()->posts()->save($post);

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post = auth()->user()->posts()->find($id);

        $categories = Category::get();

        return view('user.post.update', compact('post', 'categories'));
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $post = auth()->user()->posts()->find($request->id);

        $file = $request->file('image');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('image', $nama_file);

        Storage::delete('public/image/'.$post->old_image);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $nama_file;
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category_id;

        auth()->user()->posts()->save($post);

        return redirect('/posts');
    }
    
    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);

        Storage::delete('public/image/'.$post->image);

        $post->delete();

        return redirect('/posts');
    }
}
