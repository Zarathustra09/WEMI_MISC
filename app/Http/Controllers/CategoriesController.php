<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("categories.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255', // Example validation rules, adjust as needed
        ]);

        // Create a new category instance with the validated data
        $category = new Category();
        $category->name = $request->input('name');

        // Save the category to the database
        $category->save();

        // Redirect back to the index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the category by its ID
        $category = Category::findOrFail($id);

        // Pass the category to the edit view
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255', // Example validation rules, adjust as needed
        ]);

        // Find the category by its ID
        $category = Category::findOrFail($id);

        // Update the category with the validated data
        $category->name = $request->input('name');
        $category->save();

        // Redirect back to the index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the category by its ID
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
