<?php

namespace App\Http\Controllers;

use App\Models\mst_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống'
        ]);
        $email = $request->email;
        $password = $request->password;
        $user = mst_users::where('email', $email)->where('isActive', 1)->first();
        if ($user) {
            if ((Hash::check($password, $user->password))) {
                Session::put('user', $user->id);
                if ($request->remember == 'on') {
                    mst_users::where('email', $email)->update(['remember_token' => Session::get('user')]);
                }
                mst_users::where('email', $email)->update(['last_login_at' => Carbon::now('Asia/Ho_Chi_Minh')]);
                mst_users::where('email', $email)->update(['last_login_ip' => $request->ip()]);
                return redirect()->route('products');
            } else {
                return redirect()->back()->with('error', 'Mật khẩu không đúng');
            }
        } else {
            return redirect()->back()->with('error', 'Email không tồn tại hoặc bị khóa');
        }
    }
}
