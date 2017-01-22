<?php
namespace App\Http\Controllers\Admin;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Input;
use Form;
use Panoscape\Vuforia\VuforiaWebService;
use App\Http\Controllers\Controller;

class Users extends Controller
{

    function __construct()
    {
        $this->middleware('adminmiddleware');
    }
    public function index(VuforiaWebService $vws)
    {



        $categories = User::orderBy('id', 'ASC')->get();
        return view('admin.users.index',['users'=>$categories]);

    }

    public function create()
    {


        return view('admin.users.add');
        //
    }

    public function store(Request $request)
    {

        $category = new User;
        $category->name = $request->name;
        $category->email = $request->email;
        $category->role = 'user';
        $category->status = 'yes';
        $category->password = md5($request->password);
        $category->save();
        \Session::flash('addcat', 'User  Add Successfully  !');
        return redirect('admin/users');

    }
    public function destroy($id){

        User::destroy($id);
        \Session::flash('delcat', 'User  Deleted Successfully  !');
        return redirect('admin/users');
    }
    public function activate(Request $request,$id){

        $category = User::findOrFail($id);
        $category->status = 1;
        $category->save();
        \Session::flash('activate', 'User  Activated Successfully  !');
        return redirect('admin/users');
    }
    public function deactivate(Request $request,$id){

        $category = User::findOrFail($id);
        $category->status = 0;
        $category->save();
        \Session::flash('deactivate', 'User  Deactivated Successfully  !');
        return redirect('admin/projects');
    }

    public function edit($id)
    {

        $category = User::findOrFail($id);
        return view('admin.users.edit',['user'=>$category]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = User::findOrFail($id);
        $category->name = $request->name;
        $category->email = $request->email;
        if(isset($request->password) && $request->password!='') {
            $category->password = md5($request->password);
        }
        $category->save();
        \Session::flash('updatecat', 'User Updated Successfully  !');
        return redirect('admin/users');
    }





}
