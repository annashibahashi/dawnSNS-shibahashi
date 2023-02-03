<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\User;
use App\Post;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /*自分のプロフィール*/
    public function profile(Request $request)
    {
        $auth = Auth::user();

        $followlist = DB::table('follows')
            ->where('follower', Auth::id())
            ->count();

        $followerlist = DB::table('follows')
            ->where('follow', Auth::id())
            ->count();
        return view('users.profile', ['auth' => $auth, 'followlist' => $followlist, 'followerlist' => $followerlist]);
    }

    /**プロフィール編集
     * 画像の保存：シンボリックリンクstorage/app/publicに保存してpublic/storage/imagesで画像を参照できる
     * ウェブからstorageの下のファイルにアクセスできないから。
     * storeAs()特定の名前を与えて保存したいとき
     */
    public function update(Request $request)
    {

        $request->validate([
            'username' => ['string', 'min:4', 'max:12'],
            'mail' => ['string', 'email', 'min:4', 'max:50', Rule::unique('users')->ignore(Auth::id(), 'id'),],
            'bio' => ['max:200'],
            'images' => ['file', 'mimes:jpg,png,bmp,gif,svg,jpeg,PNG']
        ], [
            'username.min' => '４文字以上で入力してください',
            'username.max' => '１２文字以内で入力してください',
            'mail.unique' => 'このメールアドレスは既に使われています',

            'bio.max' => '200文字以内で入力してください',
            'images.mimes' => 'jpg、pnj、bmp、gif、svg、jpeg、PNGの形式のファイルのみ有効です',
        ]);

        $username = $request->input('username');
        $auth = Auth::user();
        $auth->username = $request->input('username');

        if (request('newpassword')) {
            $request->validate([
                'newpassword' => ['required', 'string', 'alpha_num', 'min:4', 'max:12', 'unique:users']
            ], [
                'newpassword.required' => 'パスワードが未入力です',
                'newpassword.alpha_num' => '英数字で入力してください',
                'newpassword.min' => '４文字以上で入力してください',
                'newpassword.max12' => '１２文字以内で入力してください',
                'newpassword.unique' => 'このパスワードは既に使われています',
            ]);
            $auth->password = bcrypt($request->input('newpassword'));
        } else {
            $password = DB::table('users')
                ->where('id', Auth::id())
                ->value('password');

            $auth->password = $password;
        }

        $auth->mail = $request->input('mail');
        $auth->bio = $request->input('bio');
        $auth->save();

        $images = $request->file('images');

        if (isset($images)) {
            $imageName = $images->getClientOriginalName();
            $images->storeAs('public/images', $imageName);
            $auth->images = $imageName;
            $auth->save();
        } else {
            $images = DB::table('users')
                ->where('id', Auth::id())
                ->value('images');
            $auth->images = $images;
            $auth->save();
        }

        return redirect('/profile')->with('password', $auth['password']);
    }


    /**検索　$query全レコード(ユーザーたち)の取得　if(!empty　空じゃないとき)のところでユーザーネームの検索機能。 */
    public function search(Request $request)
    {
        $auth = Auth::user();
        $users = User::all();
        $search = $request->input('search');
        $query = User::query();
        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();

        $followlist = DB::table('follows')
            ->where('follower', Auth::id())
            ->count();

        $followerlist = DB::table('follows')
            ->where('follow', Auth::id())
            ->count();


        if (!empty($search)) {
            $query = User::query();
            $query->where('username', 'like', '%' . $search . '%');
        }

        $users = $query->get();
        return view('users.search', ['auth' => $auth, 'users' => $users, 'followings' => $followings, 'followlist' => $followlist, 'followerlist' => $followerlist, 'search' => $search]);
    }


    /**相手のプロフィール　usersテーブルのidから表示するデータの選択。一人の画面だからfirst */
    public function otherProfile($id)
    {
        $auth = Auth::user();

        $user = DB::table('users')
            ->where('id', $id)
            ->select('username', 'bio', 'images', 'id')
            ->first();

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.user_id', $id)
            ->select('users.username', 'posts.posts', 'users.images', 'posts.created_at', 'posts.id',)
            ->orderBy('posts.created_at', 'desc')
            ->get();


        $followings = DB::table('follows')
            ->where('follower', Auth::id())
            ->get();


        $followlist = DB::table('follows')
            ->where('follower', Auth::id())
            ->count();

        $followerlist = DB::table('follows')
            ->where('follow', Auth::id())
            ->count();
        return view('users.otherProfile', ['posts' => $posts, 'auth' => $auth, 'followlist' => $followlist, 'followerlist' => $followerlist, 'followings' => $followings, 'user' => $user]);
    }
}
