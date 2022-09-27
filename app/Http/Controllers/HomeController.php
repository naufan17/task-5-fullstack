<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);

        return view('home', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::join('categories', 'posts.category_id', '=', 'categories.id')->find($id);
        $user = User::find($post->user_id);

        return view('show-post', compact('post', 'user'));
    }
}
