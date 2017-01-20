<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Input;
use Form;
use App\Http\Controllers\Controller;

class Login extends Controller
{



    function index(Request $request ){
       $user= $request->session()->get('adminid');
        if($user!=null):
        return back();
        else:
        return   view('admin.login');
        endif;
    }
    function validenter(Request $request ){
        $email=$request->input('email');
        $password=$request->input('password');
        $cust=DB::table('users')->where('email','=',$email ,'and' ,' password','=',md5($password))->first();
        if($cust!=null):
            $request->session()->put('emailadmin', $cust->email);
            $request->session()->put('adminid', $cust->id);
            return redirect('admin/home');
        else:
            return   view('admin.login');
        endif;
    }

    public function logout()
    {
        \Session::forget('emailadmin');
        \Session::forget('adminid');
        \Session::forget('email');
        return redirect('admin/login');

    }

}
