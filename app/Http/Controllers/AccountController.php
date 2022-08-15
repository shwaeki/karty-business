<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function index()
    {

        $search = request('search') ? request('search') : null;
        if (isset($search) && $search != null)
            //    $admins = Admin::where('name',$search)->get();
            $admins = Admin::where('name', 'LIKE', "%$search%")->get();
        else
            $admins = Admin::all();

        $data = [
            'admins' => $admins,

        ];
        return view('admin.accounts.index', $data);
    }


    public function create()
    {
        return view('admin.accounts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required',
            'usertype' => 'required',
        ]);


        Admin::create([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'phone' => request('phone'),
            'type' => request('usertype'),
            'password' => Hash::make(request('password')),
        ]);


        $request->session()->flash('massage', 'تم اضافة المستخدم بنجاح');
        return redirect()->route('accounts.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = [
            'account' => Admin::findOrFail($id),

        ];
        return view('admin.accounts.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $id,
//            'email' => 'required|string|email|max:255|unique:admins,email,'.$id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'phone' => 'required',
            'usertype' => 'required',
        ]);

        $account = Admin::findOrFail($id);
        $account->name = request('name');
        $account->username = request('username');
        $account->phone = request('phone');
        $account->type = request('usertype');
        if (request('password'))
            $account->password = Hash::make(request('password'));
        $account->save();

        $request->session()->flash('massage', 'تم تعديل بيانات المستخدم بنجاح');
        return redirect()->route('accounts.index');
    }


    public function destroy($id)
    {
        $account = Admin::findOrFail($id);
        $account->delete();
        session()->flash('massage', 'تم حذف المستخدم بنجاح');
        return redirect()->route('accounts.index');
    }
}
