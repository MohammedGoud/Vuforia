<?php
namespace App\Http\Controllers\Admin;

use App\Marker;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Input;
use Form;
use App\Http\Controllers\Controller;
use Panoscape\Vuforia\VuforiaWebService;


class Markers extends Controller
{
    public function __construct()
    {
        $this->middleware('adminmiddleware');
    }
    public function index()
    {

        if(isset($_GET['id'])) {
            $project_id=$_GET['id'];
            $categories = Marker::where('project_id','=',$project_id)->orderBy('id', 'ASC')->get();
        }else{
            $categories = Marker::orderBy('id', 'ASC')->get();

        }
            return view('admin.markers.index',['categories'=>$categories]);

    }

    public function create()
    {

        $project_id=$_GET['id'];
        return view('admin.markers.add',['project_id'=>$project_id]);
        //
    }

      public function store(Request $request,VuforiaWebService $vws)
    {

        $category = new Marker;
        $category->meta_data = $request->meta_data;
        $category->project_id = $request->project_id;
        $category->title = $request->name;
        if($request->hasFile('image')) {
            $path = public_path() . '/markers/';
            $file = Input::file('image');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('image')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->url = $new_image;


            $target = new \Panoscape\Vuforia\Target;
            $target->name = $request->name;
            $target->width = 10;
            $target->image = file_get_contents(url('markers/' . $new_image));
            $target->metadata = $request->meta_data;
            $target->active = true;
            $tar = $vws->addTarget($target);
        }

        $category->vws_id = $request->name;
         $category->save();
        \Session::flash('addcat', 'Markers  Add Successfully  !');
        return redirect('admin/markers?id='.$request->project_id);

    }
    public function destroy($id){

        Marker::destroy($id);
        \Session::flash('delcat', 'Markers  Deleted Successfully  !');
        return redirect('admin/markers');
    }
    public function activate(Request $request,$id){

        $category = Marker::findOrFail($id);
        $category->status = 1;
        $category->save();
        \Session::flash('activate', 'Markers  Activated Successfully  !');
        return redirect('admin/markers');
    }
    public function deactivate(Request $request,$id){

        $category = Marker::findOrFail($id);
        $category->status = 0;
        $category->save();
        \Session::flash('deactivate', 'Markers  Deactivated Successfully  !');
        return redirect('admin/markers');
    }

    public function edit($id)
    {

        $category = Marker::findOrFail($id);
        return view('admin.markers.edit',['project'=>$category]);
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
        $category = Marker::findOrFail($id);
        $category->meta_data = $request->meta_data;
        $category->project_id = $request->project_id;
        $category->title = $request->name;
        if($request->hasFile('image')) {
            $path = public_path() . '/markers/';
            $file = Input::file('image');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('image')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->url = $new_image;
        }
        $category->vws_id = $request->name;
        $category->save();
        \Session::flash('updatecat', 'Markers  Updated Successfully  !');
        return redirect('admin/markers?id='.$request->project_id);
    }





}
