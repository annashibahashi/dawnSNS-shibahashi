<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class FollowsController extends Controller
{
    /**フォローユーザー一覧、投稿一覧　
     * followerはログインユーザーのidが入ってる。そいつのフォローを取得
     * pluck 指定したキーのデータだけを取得する
     * whereIn 複数含まれている可能性があるときに使う(フォローしてる人複数いる)*/

    public function followList(Request $request){
        $follow_id = DB::table('follows')
            ->where('follower',Auth::id())
            ->pluck('follow');

        $icons = DB::table('users')
            ->whereIn('id',$follow_id)
            ->select('images','id')
            ->get();

        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->whereIn('user_id',$follow_id)
            ->select('users.username','posts','users.images','posts.created_at as p_created_at')
            ->orderBy('posts.created_at','desc')
            ->get();

        $auth = Auth::user();

        $followlist = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerlist = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();

        return view('follows.followList' , ['auth'=>$auth , 'followlist'=>$followlist , 'followerlist'=>$followerlist , 'icons'=>$icons , 'posts'=>$posts]);
    }


    /**フォロワー一覧 */
    public function followerList(Request $request){
        $follower_id = DB::table('follows')
            ->where('follow',Auth::id())
            ->pluck('follower');

        $icons = DB::table('users')
            ->whereIn('id',$follower_id)
            ->select('images','id')
            ->get();

        $posts = DB::table('posts')
            ->join('users','users.id','=','posts.user_id')
            ->whereIn('user_id',$follower_id)
            ->select('users.username','posts','users.images','posts.created_at as p_created_at')
            ->orderBy('posts.created_at','desc')
            ->get();

        $auth = Auth::user();

        $followlist = DB::table('follows')
            ->where('follower',Auth::id())
            ->count();

        $followerlist = DB::table('follows')
            ->where('follow',Auth::id())
            ->count();

        return view('follows.followerList' , ['auth'=>$auth , 'followerlist'=>$followerlist , 'followlist'=> $followlist , 'icons'=>$icons , 'posts'=>$posts]);
    }


    public function follow(Request $request){
        $follow = $request->input('follow');

        DB::table('follows')
            ->insert([
                'follower' => Auth::id(),
                'follow' => $follow,
                'created_at' => now(),
            ]);
        return back();
    }

    public function unfollow(Request $request){
        $unfollow = $request->input('unfollow');

        DB::table('follows')
            ->where('follower' , Auth::id())
            ->where('follow' , $unfollow)
            ->delete();
        return back();
    }


}
