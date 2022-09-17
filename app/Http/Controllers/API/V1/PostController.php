<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->orderBy('created_at', 'desc')->paginate(15);

        if(!$posts){
            return response()->json([
                'status' => 'fail',
                'message' => 'Post failed to get'
            ], 404);
        }else{
            return response()->json([
                'status' => 'success',
                'data' => $posts
            ], 200);
        }
    }
    
    public function show($id)
    {
        $post = auth()->user()->posts()->find($id);

        if(!$post){
            return response()->json([
                'status' => 'fail',
                'message' => 'Post failed to get'
            ], 404);
        }else{
            return response()->json([
                'status' => 'success',
                'data' => $post
            ], 200);
        }
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $request->image;
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category_id;

        if(auth()->user()->posts()->save($post)){
            return response()->json([
                'status' => 'success',
                'message' => 'Post stored successfully',
                'data' => $post,
            ], 201);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Post failed to store'
            ], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = auth()->user()->posts()->find($id);

        if(!$post){
            return response()->json([
                'status' => 'fail',
                'message' => 'Post not found',
            ], 404);
        }

        if($post->fill($request->all())->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Post updated successfully',
            ], 200);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Post failed to update'
            ], 404);
        }
    }
    
    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);

        if(!$post){
            return response()->json([
                'status' => 'fail',
                'message' => 'Post not found',
            ], 404);
        }

        if($post->delete()){
            return response()->json([
                'status' => 'success',
                'message' => 'Post deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Post can not be deleted'
            ], 404);
        }
    }
}
