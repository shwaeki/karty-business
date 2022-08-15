<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use function redirect;
use function session;
use function view;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:40',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        session()->flash('massage', 'تم اضافة  فئة جديد بنجاح');
        return redirect()->route('categories.index');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('massage', 'تم حذف الفئة بنجاح');
        return redirect()->route('categories.index');
    }
}
