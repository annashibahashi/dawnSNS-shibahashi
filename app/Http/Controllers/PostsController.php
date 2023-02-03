<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
/**topページ　投稿一覧
 * first()　最初のレコード、単一取得　
 * get()　複数取得
 * count　ログインユーザーのをカウントしてる */
class PostsController extends Controller
{
    public function index(){
        $auth =  DB::table('users')
            ->where('id',Auth::id())
            ->first();
        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->select('posts.id','posts.posts','posts.user_id','posts.created_at','users.username','users.images')
            ->orderBy('posts.created_at','desc')
            ->get();

         $followlist = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerlist = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();
        return view('posts.index' , ['posts'=>$posts,'auth'=>$auth, 'followlist'=>$followlist , 'followerlist'=>$followerlist]);

    }

    /**新規投稿　postテーブルにログインユーザーが投稿を作成してtop画面に戻る */
    public function create(Request $request){
        DB::table('posts')
            ->insert([
                'user_id' => Auth::id(),
                'posts' => $request->input('posts'),
                'created_at' => now(),
            ]);
        return redirect('/top');
    }

    /**投稿削除　postテーブルからwhereで該当のid探してdelete(削除)top画面に戻る */
    public function delete($id){
        \DB::table('posts')
            ->where('id',$id)
            ->delete();
        return redirect('/top');
    }


    /**投稿編集　postテーブルからwhereで編集したい投稿(inputされたやつ)のid探す。update(up_postでinputされたやつ)で更新 */
    public function update(Request $request){
        \DB::table('posts')
            ->where('id',$request->input('id'))
            ->update([
                'posts'=>$request->input('up_post')
            ]);
        return redirect('/top');
    }

    public function test(Request $request){

        $auth =  Auth::user();

        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->where('user_id',Auth::id())
            ->select('users.username','posts.posts','users.images','posts.created_at','posts.id','posts.user_id')
            ->orderBy('posts.created_at','desc')
            ->get();

        return view('posts.test',['auth'=>$auth,'posts'=>$posts]);
    }
}
