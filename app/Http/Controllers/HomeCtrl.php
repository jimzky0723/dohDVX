<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Session::get('auth');
        if($user->level=='admin' || $user->level=='user'){
            return redirect('admin');
        }else if($user->level=='hospital'){
            return redirect($user->level);
        }
    }
}
