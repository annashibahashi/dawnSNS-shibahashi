<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'min:4', 'max:12'],
            'mail' => ['required', 'string', 'email', 'min:4', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'alpha_num', 'min:4', 'max:12', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'alpha_num', 'min:4', 'max:12'],
        ], [
            'username.required' => '名前が未入力です',
            'username.min' => '４文字以上で入力してください',
            'username.max' => '１２文字以内で入力してください',
            'mail.required' => 'メールアドレスが未入力です',
            'mail.unique' => 'このメールアドレスは既に使われています',
            'password.required' => 'パスワードが未入力です',
            'password.confirmed' => 'パスワードが一致しません',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    /*新規ユーザー登録入力情報でユーザー作成 */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    /*新規登録から登録完了まで ,withでusernameをコントローラーから送る.if登録(added)できたら。出来なかったら新規登録画面*/
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $this->validator($data)->validate();
            $this->create($data);
            return redirect('/added')->with('name', $data['username']);
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
