<?php

namespace App\Http\Controllers;

use App\Dengvaxia;
use Illuminate\Http\Request;

class DengvaxiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function dengvaxia(Request $request)
    {
        if(isset($request)){
            $keyword = $request->keyword;
        } else {
            $keyword = "";
        }
        $dengvaxia = new Dengvaxia();
        $records = $dengvaxia->
        where(function($q) use ($keyword){
            $q->where('fname','like',"%$keyword%")
                ->orWhere('lname','like',"%$keyword%");
        })
            ->orderBy('lname','asc')
            ->paginate(30);
        return view('admin.dengvaxia',[
            'title' => 'List of Dengvaxia',
            'records' => $records,
            'keyword' => $keyword
        ]);
    }


}
