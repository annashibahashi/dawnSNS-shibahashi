<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mail' => ['required', 'string', 'email', 'min:4', 'max:50', 'confirmed'],
            'password' => ['required', 'string', 'alpha_num', 'min:4', 'max:12', 'confirmed'],
        ], [
            'mail.required' => 'メールアドレスが未入力です',
            'mail.confirmed' => 'メールアドレスが一致しません',
            'password.required' => 'パスワードが未入力です',
            'password.confirmed' => 'パスワードが一致しません',
        ]);
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only('mail', 'password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if (Auth::attempt($data)) {
                $name = Auth::user();
                return redirect('/top')->with('name', $name['username']);
            }
        }
        return view("auth.login");
    }

    public function top()
    {
        return view('posts.index');
    }

    /**ログアウト */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
