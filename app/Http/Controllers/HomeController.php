<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = POST::get();

        return view('home', compact('posts'));
    }

    public function show($id)
    {
        $post = POST::find($id);

        return view('show-post', compact('post'));
    }
}
