<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:super-admin');
        $this->middleware('permission:create category', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit category', ['only' => ['update', 'edit',]]);
        $this->middleware('permission:soft delete category', ['only' => ['destroy']]);
        $this->middleware('permission:show all categories', ['only' => ['index']]);
    }
    public function index()
    {
        $categories = Category::all();
        return view('Admin.Template.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('Admin.Template.Category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->parent_id['0']);
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable',
        ]);

        if ($request->parent_id) {

            foreach ($request->parent_id as $value) {
                Category::create([
                    'name' => $request->name,
                    'parent_id' => $value,
                ]);
            }
        } else {
            Category::create([
                'name' => $request->name,
            ]);
        }



        return redirect(route('categories.index'))->with('success', 'category created successfuly');
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
        $categories = Category::all();
        // dd($categories);
        $category = Category::findOrFail($id);

        // $sunbCategories = $category->child->pluck('name', 'name')->all();

        // dd( $sunbCategories);
        return view('Admin.Template.Category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|numeric',
        ]);

        $category = Category::findOrFail($id);


        //  dd($category->parent_id);

        if ($category->parent_id == $request->categories) {

            return redirect()->back()->with('error', 'this is cayegory aready taken');
        } else {

            $category->update([
                'name' => $request->name,
                'parent_id' => $request->categories,
            ]);
            return redirect(route('categories.index'))->with('success', 'category updated successfuly');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $categoryID)
    {
        $category = Category::findOrFail($categoryID);
        $category->delete();
        return redirect(route('categories.index'))->with('success', 'category deleted successfuly');
    }
}
