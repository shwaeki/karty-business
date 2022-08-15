<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use function redirect;
use function request;
use function session;
use function view;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index')->with('cities', $cities);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);


        City::create([
            'name' => request('name'),
            'price' => request('price'),
        ]);

        session()->flash('massage', 'تم اضافة  مدينة  جديد بنجاح');
        return redirect()->route('cities.index');

    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $city->name = request('name');
        $city->price = request('price');
        $city->save();

        session()->flash('massage', 'تم تعديل المدينة بنجاح');
        return redirect()->route('cities.index');
    }


    public function destroy(City $city)
    {
        $city->delete();
        session()->flash('massage', 'تم حذف المدينة بنجاح');
        return redirect()->route('cities.index');
    }
}
