<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Font;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function public_path;
use function redirect;
use function request;
use function session;
use function view;

class FontController extends Controller
{


    public function index()
    {
        $fonts = Font::all();
        return view('admin.fonts.index')->with('fonts', $fonts);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'string|max:40',
            'font' => 'file|max:2028',
        ]);


        if ($request->hasFile('font')) {
            $font = request('font');
            $fontName = Str::random(10) . '_' . time() . '.' . $font->getClientOriginalExtension();
            $font->move(public_path('/fonts/'), $fontName);


            $font = new Font();
            $font->name = $request->name;
            $font->path = $fontName;
            $font->save();
            session()->flash('massage', 'تم اضافة  رمز جديد بنجاح');
            return redirect()->route('fonts.index');
        }
    }


    public function create()
    {
        return view('admin.fonts.create');
    }




    public function destroy(Font $font)
    {

        $font_name = $font->path;

        if (File::exists(public_path('/fonts/' . $font_name))) {
            File::delete(public_path('/fonts/' . $font_name));
        }

        $font->delete();
        session()->flash('massage', 'تم حذف الخط بنجاح');
        return redirect()->route('fonts.index');
    }
}
