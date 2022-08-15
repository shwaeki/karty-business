<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use function redirect;
use function session;
use function view;

class CouponController extends Controller
{
    public function index()
    {
        $data = [
            'coupons' => Coupon::all(),

        ];
        return view('admin.coupons.index', $data);
    }


    public function create()
    {
        return view('admin.coupons.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:40',
            'image' => 'mimes:png|max:1014',
        ]);


        Coupon::create($request->all());
        session()->flash('massage', 'تم اضافة  كوبون جديد بنجاح');
        return redirect()->route('coupons.index');

    }


    public function destroy(Coupon $coupon)
    {

        $coupon->delete();
        session()->flash('massage', 'تم حذف الكوبون بنجاح');
        return redirect()->route('coupons.index');
    }
}
