<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = auth()->user()->categories()->paginate(25);

        return view('user.category.index', compact('categories'));
    }

    public function formStore()
    {
        return view('user.category.store');
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

        auth()->user()->categories()->save($category);
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

        $category->fill($request->all())->save();
    }
    
    public function destroy($id)
    {
        $category = auth()->user()->categories()->find($id);

        $category->delete();
    }
}
