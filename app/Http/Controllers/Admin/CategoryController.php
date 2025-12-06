<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('campaigns')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.categories.index', [
            'title' => 'Categories Management',
            'subtitle' => 'Manage platform categories',
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.categories.create', [
            'title' => 'Create Category',
            'subtitle' => 'Add new category',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
            'slug' => ['required', 'string', 'max:100', 'unique:categories,slug'],
            'icon' => ['required', 'string', 'max:10'],
            'description' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $validated['slug'] = Str::lower($validated['slug']);
        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::withCount('campaigns')->findOrFail($id);

        return view('admin.categories.edit', [
            'title' => 'Edit Category',
            'subtitle' => 'Update category information',
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $id],
            'slug' => ['required', 'string', 'max:100', 'unique:categories,slug,' . $id],
            'icon' => ['required', 'string', 'max:10'],
            'description' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $validated['slug'] = Str::lower($validated['slug']);
        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::withCount('campaigns')->findOrFail($id);

        if ($category->campaigns_count > 0) {
            return back()->with('error', 
                "Cannot delete category '{$category->name}'. It has {$category->campaigns_count} active campaigns.");
        }

        $categoryName = $category->name;
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', "Category '{$categoryName}' deleted successfully!");
    }
}