<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = auth()->user()->categories()->orderBy('name')->get();

        if(!$categories){
            return response()->json([
                'status' => 'fail',
                'message' => 'Category failed to get'
            ], 404);
        }else{
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ], 200);
        }
    }
    
    public function show($id)
    {
        $category = auth()->user()->categories()->find($id);

        if(!$category){
            return response()->json([
                'status' => 'fail',
                'message' => 'Category not found'
            ], 404);
        }else{
            return response()->json([
                'status' => 'success',
                'data' => $category
            ], 200);
        }
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = new category();
        $category->name = $request->name;
        $category->user_id = auth()->user()->id;

        if(auth()->user()->categories()->save($category)){
            return response()->json([
                'status' => 'success',
                'message' => 'Category stored successfully',
                'data' => $category,
            ], 201);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Category failed to store'
            ], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = auth()->user()->categories()->find($id);

        if(!$category){
            return response()->json([
                'status' => 'fail',
                'message' => 'Category not found',
            ], 404);
        }

        if($category->fill($request->all())->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully',
            ], 200);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Category failed to update'
            ], 404);
        }
    }
    
    public function destroy($id)
    {
        $category = auth()->user()->categories()->find($id);

        if(!$category){
            return response()->json([
                'status' => 'fail',
                'message' => 'Category not found',
            ], 404);
        }

        if($category->delete()){
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Category can not be deleted'
            ], 404);
        }
    }
}
