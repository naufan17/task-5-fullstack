<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

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
        $categories = auth()->user()->categories()->orderBy('name')->paginate(25);

        return view('user.category.index', compact('categories'));
    }

    public function create()
    {
        return view('user.category.store');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $category = new category();
        $category->name = $request->name;
        $category->user_id = auth()->user()->id;

        auth()->user()->categories()->save($category);

        return redirect('/categories');
    }

    public function edit($id)
    {
        $category = auth()->user()->categories()->find($id);

        return view('user.category.update', compact('category'));
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $category = auth()->user()->categories()->find($request->id);

        $category->name = $request->name;
        $category->user_id = auth()->user()->id;

        auth()->user()->categories()->save($category);

        return redirect('/categories');
    }
    
    public function destroy($id)
    {
        $category = auth()->user()->categories()->find($id);

        $category->delete();

        return redirect('/categories');
    }
}
