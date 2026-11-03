<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->get();

        return view('admin.categories.index', compact('categories'));
    }


    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }


    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

        ]);


        // Generate slug automatically
        $validated['slug'] = Str::slug($validated['name']);


        // Upload category image
        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }


        // Category active by default
        $validated['is_active'] = $request->boolean('is_active', true);


        // Create category
        Category::create($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }


    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $category->id,
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

        ]);


        // Generate slug automatically
        $validated['slug'] = Str::slug($validated['name']);


        // Upload new category image
        if ($request->hasFile('image')) {

            // Delete old image
            if (
                $category->image &&
                Storage::disk('public')->exists($category->image)
            ) {
                \Storage::disk('public')
                    ->delete($category->image);
            }


            // Store new image
            $validated['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }


        // Category status
        $validated['is_active'] = $request->boolean('is_active');


        // Update category
        $category->update($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        // Delete category image
        if (
            $category->image &&
            \Storage::disk('public')->exists($category->image)
        ) {
            \Storage::disk('public')
                ->delete($category->image);
        }


        // Delete category
        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}