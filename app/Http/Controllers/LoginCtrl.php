<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginCtrl extends Controller
{
    public function __construct()
    {

    }

    public function login()
    {
        if(Session::get('auth')){
            return redirect('/');
        }
        return view('auth.login');
    }

    public function validateLogin(Request $req)
    {
        $login = User::where('username',$req->username)
            ->first();
        if($login){

            if($login->status==='inactive'){
                return 'inactive';
            }else{
                if(Hash::check($req->password,$login->password))
                {
                    Session::put('auth',$login);
                    return redirect('admin');
                    if($login->level=='admin' || $login->level=='user'){
                        return 'admin';
                    }else if($login->level=='hospital'){
                        return 'hospital';
                    }else{
                        Session::forget('auth');
                        return 'denied';
                    }
                }
                else
                {
                    Session::flash('username',$req->username);
                    return redirect('/login');
                    //return 'error';
                }
            }
        }else{
            Session::flash('username',$req->username);
            return redirect('/login');
            //return 'error';
        }

    }

    public function checkLogin()
    {

    }
}
