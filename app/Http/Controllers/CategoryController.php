<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): Factory|View|Application
    {
        $this->authorize('admin', Category::class);
        $categories = Category::withCount('tickets')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Category $category): Factory|View|Application
    {
        $this->authorize('admin', Category::class);
        return view('categories.edit', compact('category'));
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): Factory|View|Application
    {
        $this->authorize('admin', Category::class);
        return view('categories.create');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('admin', Category::class);
        $category = new Category($request->all());
        $category->save();
        return redirect()->route('categories.index');
    }


    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->authorize('admin', Category::class);
        $category->fill($request->all());
        $category->update();
        return redirect()->route('categories.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('admin', Category::class);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
