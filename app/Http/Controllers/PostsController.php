<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;

class PostsController extends Controller
{
    public function index(){
        $posts = DB::table('posts')
        ->get();
        return view('posts.index' , ['posts'=>$posts]);
    }

    public function create(Request $request){




    }
}
