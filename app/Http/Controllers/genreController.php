<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class genreController extends Controller
{
    public function index(){
        $cate = Category::all();
        return view('genre',compact('cate'));
    }

}
