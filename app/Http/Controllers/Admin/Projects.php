<?php
namespace App\Http\Controllers\Admin;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Input;
use Form;
use Panoscape\Vuforia\VuforiaWebService;
use App\Http\Controllers\Controller;

class Projects extends Controller
{

        function __construct()
        {
        $this->middleware('adminmiddleware');
        }
    public function index(VuforiaWebService $vws)
    {



        $categories = Project::orderBy('id', 'ASC')->get();
        return view('admin.projects.index',['categories'=>$categories]);

    }

    public function create()
    {


        return view('admin.projects.add');
        //
    }

      public function store(Request $request)
    {

        $category = new project;
        $category->title = $request->title;
        $category->breif = $request->breif;
         $category->save();
        \Session::flash('addcat', 'Project  Add Successfully  !');
        return redirect('admin/projects');

    }
    public function destroy($id){

        Project::destroy($id);
        \Session::flash('delcat', 'Project  Deleted Successfully  !');
        return redirect('admin/projects');
    }
    public function activate(Request $request,$id){

        $category = Project::findOrFail($id);
        $category->status = 1;
        $category->save();
        \Session::flash('activate', 'Category  Activated Successfully  !');
        return redirect('admin/projects');
    }
    public function deactivate(Request $request,$id){

        $category = Project::findOrFail($id);
        $category->status = 0;
        $category->save();
        \Session::flash('deactivate', 'Category  Deactivated Successfully  !');
        return redirect('admin/projects');
    }

    public function edit($id)
    {

        $category = Project::findOrFail($id);
        return view('admin.projects.edit',['project'=>$category]);
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
        $path = public_path() . '/assets/images/categories/';
        $category = Project::findOrFail($id);

        $category->title = $request->title;
        $category->breif = $request->breif;
        $category->save();
        \Session::flash('updatecat', 'Project  Updated Successfully  !');
        return redirect('admin/projects');
    }





}
