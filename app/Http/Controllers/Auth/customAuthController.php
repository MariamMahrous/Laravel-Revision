<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

class customAuthController extends Controller
{
    public function adult(){
      //  return view('customAuth');
      return view('customAuth');
    }
    public function site(){
   
      return view('site');
    }
    public function admin(){
      
      return view('admin');
    }
    public function adminlogin(){
      return view('auth.adminlogin');
    }
    public function checkAdminLogin(Request $request){
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
    ]);
   
    if (auth::guard('admin')->attempt(['email' => $request->email , 'password' =>$request->password])) {
  
        return redirect()->intended('/admin');
    }
    return back()->withInput($request->only('email'));
}

}
