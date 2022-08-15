<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function public_path;
use function redirect;
use function request;
use function session;
use function view;

class IconController extends Controller
{


    public function index()
    {
        $data = [
            'icons' => Icon::all(),

        ];
        return view('admin.icons.index', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'string|max:40',
            'image' => 'mimes:png|max:1014',
        ]);


        if ($request->hasFile('image')) {
            $img = request('image');
            $imageName = Str::random(10) . '_' . time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('/images/Icons/'), $imageName);


            $icon = new Icon();
            $icon->name = $request->name;
            $icon->path = $imageName;
            $icon->save();
            session()->flash('massage', 'تم اضافة  رمز جديد بنجاح');
            return redirect()->route('icons.index');

        }
    }

    public function create()
    {
        return view('admin.icons.create');
    }


    public function update(Request $request, Icon $icons)
    {
        //
    }

    public function destroy(Icon $icon)
    {

        $icon_name = $icon->path;

        if (File::exists(public_path('/images/Icons/' . $icon_name))) {
            File::delete(public_path('/images/Icons/' . $icon_name));
        }

        $icon->delete();
        session()->flash('massage', 'تم حذف الرمز بنجاح');
        return redirect()->route('icons.index');
    }
}
