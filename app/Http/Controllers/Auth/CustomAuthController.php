<?php

namespace App\Http\Controllers\Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{

    public function adualt()
    {
        return view('customAuth.index');
    }

    public function site()
    {
        return view('site');

    }

    public function admin()
    {
        return view('admin');
    }

    public function show(){
        $admin=Admin::all();
        return(dd($admin));
    }

    public function adminLogin()
    {
        return view('auth.adminLogin');
    }

    public function checkAdminLogin(Request $request)
    {
        $validatedData=$request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        //return dd(Admin::all());
        if (auth::guard('admin')->attempt($validatedData)) { //method attempt return fasle

            return dd(Admin::all());
           // return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email'));
    }


}
