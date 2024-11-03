<?php

namespace App\Http\Controllers;

use App\Models\CategoriesPost;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function index()
    {
        $categories = CategoriesPost::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        CategoriesPost::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(CategoriesPost $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, CategoriesPost $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $categories = CategoriesPost::findOrFail($id);
        $categories->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
