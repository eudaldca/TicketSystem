<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::withCount('tickets')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {

    }

    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('admin', Category::class);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
