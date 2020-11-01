<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:admin', ['except' => ['logout']]);
	}

    public function showLoginForm(){
    	return view('auth.adminlogin');
    }

    public function doLogin(Request $request){
    	
    	$this->validate($request, [
    		'email' => 'required','email',
    		'password' => 'required', 'min:8'
    	]);

    	if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => 1], $request->remember)){
    		return redirect()->intended(route('admindashboard'));
    	}else{
    		return redirect('admin/login')->withInput($request->only('email', 'remember'))->with('errmessage', 'You are not an admin so u r not accessible.');
    	}
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }
}
