<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
}
