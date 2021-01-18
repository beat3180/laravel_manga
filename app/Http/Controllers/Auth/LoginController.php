<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    //追加 フォームの表示内容を変更する
    public function showAdminLoginForm()
    {
        return view('auth.login', ['authgroup' => 'admin']);
    }

    //追加
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    //logoutという関数名を使うことにより適用される
    public function logout(Request $request)
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return $this->AdminloggedOut($request);
        } else if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return $this->loggedOut($request);
        }

    }


    public function AdminloggedOut(Request $request)
    {
        //route()によりroutes/web.phpでnameを指定する必要があります
        return redirect(route('/login/admin'));
    }

    public function loggedOut(Request $request)
    {
        //route()によりroutes/web.phpでnameを指定する必要があります
        return redirect(route('login'));
    }
}
