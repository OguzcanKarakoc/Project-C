<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role_id' => 1])) {
                //echo "Success"; die;
//                Session::put('adminSession', $data['email']);
                return redirect('/admin/dashboard');
            } else {
                //echo "Failed"; die;
                return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password');
            }
        }
        return Auth::guard('admin')->check() ? redirect('/admin/dashboard') : view('admin.admin_login');
    }

    public function dashboard(Request $request)
    {
        $products = Product::orderBy('quantity')->paginate(5);

        if ($request->ajax()) {
            return view('admin.paginate', compact('products'));
        }

        return view('admin.dashboard', compact('products'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out Successfully');
    }

}
