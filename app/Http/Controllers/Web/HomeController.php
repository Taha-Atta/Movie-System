<?php

namespace App\Http\Controllers\Web;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|super-admin');

    }
    public function index()
    {
        return view('Admin.Template.index');
    }


    public function logout()
    {
        Auth::logout();
        return view('welcome');
    }

    public function create()
    {
        return view('Admin.Template.User.CreateUser');
    }


    public function search(Request $request){
        dd($request);
        $key = $request->key;
        $movies=Movie::whereHas('categories',function ($q) use($key)
        {
            $q->where('name','like',"%$key%")->get();
        });
        return to_route('Admin.Template.Movie.index', compact('movies'));
    }
}
