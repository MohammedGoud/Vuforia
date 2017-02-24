<?php
namespace App\Http\Controllers\Admin;

use App\Marker;
use App\Models;

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
    public function index(VuforiaWebService $vws)
    {
        if(isset($_GET['id']) &&  $_GET['id']!=0) {
            $project_id=$_GET['id'];
            $categories = Marker::where('project_id','=',$project_id)->orderBy('id', 'ASC')->get();
        }elseif( isset($_GET['id']) &&  $_GET['id']==0){
            $categories = Marker::orderBy('id', 'ASC')->get();

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
    public function edit($id)
    {

        $category = Marker::findOrFail($id);
        $models = Models::where('marker_id',$id)->get();
        return view('admin.markers.edit',['marker'=>$category,'models'=>$models]);
        //
    }
    public function store(Request $request,VuforiaWebService $vws)
    {

        $category = new Marker;
        $category->project_id = $request->project_id;
        $category->lat = $request->lat;
        $category->lng = $request->long;
        $category->title = $request->name;
        $category->address = $request->address;
        $modeles=array();
        $models3d=array();
        $modeles[]=array('url'=>'lat'.$request->lat);
        $modeles[]=array('url'=>'long'.$request->long);
        if($request->hasFile('model')) {
            $path = public_path() . '/models/'.str_replace(' ','_',$request->name).'/';
            $files = Input::file('model');
            foreach ($files as $file) {
                $imageName = $file->getClientOriginalName();
                $file->move($path, $imageName);
                $modeles[]=array('url'=>url('/models/'.str_replace(' ','_',$request->name).'/'.$imageName));
                array_push($models3d,$imageName);

            }
        }
        if($request->hasFile('image360')) {
            $path = public_path() . '/360/';
            $file = Input::file('image360');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('image360')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->image360 = $new_image;
            $modeles[]=array('url'=>'image360'.url('/360/'.$new_image));
        }
        if($request->hasFile('video360')) {
            $path = public_path() . '/360/';
            $file = Input::file('video360');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('video360')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->video360 = $new_image;
            $modeles[]=array('url'=>'video360'.url('/360/'.$new_image));
        }
        $data=array('data'=>$modeles);
        $new_meta=json_encode($data);
        if(!empty($modeles)){
            $medta=stripslashes($new_meta);
            $category->meta_data = $medta;
        }else{
            $medta=$request->meta_data;
            $category->meta_data = $request->meta_data;
        }
        if($request->hasFile('image')) {
            $path = public_path() . '/markers/';
            $file = Input::file('image');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('image')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->url = $new_image;
            $tar=$vws->addTarget([
                'name' => str_replace(' ','_',$request->name),
                'width' => 150,
                'path' => url('markers/' . $new_image),
                'metadata'=>$medta
            ]);
            $atgg=json_decode($tar['body']);
            $category->vws_id = $atgg->target_id;
        }
        $category->save();
        $marker_id=$category->id;
        if(!empty($models3d)) {
            for ($i = 0; $i < count($models3d); $i++) {
                $model = new Models;
                $model->marker_id = $marker_id;
                $model->url = $models3d[$i];
                $model->save();
            }
        }
        \Session::flash('addcat', 'Markers  Add Successfully  !');
        return redirect('admin/markers?id='.$request->project_id);
    }
    public function update(Request $request, $id,VuforiaWebService $vws)
    {
        $category = Marker::findOrFail($id);
        $category->project_id = $request->project_id;
        $category->lat = $request->lat;
        $category->lng = $request->long;
        $category->title = $request->name;
        $category->address = $request->address;
        $modeles=array();
        $models3d=array();
        $modeles[]=array('url'=>'lat'.$request->lat);
        $modeles[]=array('url'=>'long'.$request->long);

        if($request->hasFile('model')) {
            $path = public_path() . '/models/'.str_replace(' ','_',$request->name).'/';
            $files = Input::file('model');
            foreach ($files as $file) {
                $imageName = $file->getClientOriginalName();
                $file->move($path, $imageName);
                $modeles[]=array('url'=>url('/models/'.str_replace(' ','_',$request->name).'/'.$imageName));
                array_push($models3d,$imageName);

            }
        }
        if($request->hasFile('image360')) {
            $path = public_path() . '/360/';
            $file = Input::file('image360');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('image360')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->image360 = $new_image;
            $modeles[]=array('url'=>'image360'.url('/360/'.$new_image));
        }
        if($request->hasFile('video360')) {
            $path = public_path() . '/360/';
            $file = Input::file('video360');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('video360')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->video360 = $new_image;
            $modeles[]=array('url'=>'video360'.url('/360/'.$new_image));
        }
        $data=array('data'=>$modeles);
        $new_meta=json_encode($data);
        if(!empty($modeles)){
            $medta=stripslashes($new_meta);
            $category->meta_data = $medta;
        }else{
            $medta=$request->meta_data;
            $category->meta_data = $request->meta_data;
        }

        if($request->hasFile('image')) {
            $path = public_path() . '/markers/';
            $file = Input::file('image');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('image')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->url = $new_image;
            $vws->updateTarget($category->vws_id,
                ['name' => str_replace(' ','_',$request->name),
                    'width' => 150,
                    'path' => url('markers/' . $new_image),
                    'metadata'=>$medta
                ]);

        }
        $category->save();
        $marker_id=$category->id;
        if(!empty($models3d)) {
            for ($i = 0; $i < count($models3d); $i++) {
                $model = new Models;
                $model->marker_id = $marker_id;
                $model->url = $models3d[$i];
                $model->save();
            }
        }
        \Session::flash('addcat', 'Markers  Add Successfully  !');
        return redirect('admin/markers?id='.$request->project_id);
       }
    public function destroy($id,VuforiaWebService $vws){
        $category = Marker::findOrFail($id);
        $models = Models::findOrFail($category->id);
        $vws->deleteTarget($category->target_id);
        unlink(url('/markers/'.$category->url));
        if(isset($category->image360)){
            unlink(url('/360/'.$category->image360));
        }
        if(isset($category->video360)){
            unlink(url('/360/'.$category->video360));
        }
        dd($models);
        if(!empty($models)){
           foreach($models as $model){
               unlink(url('models/'.str_replace(' ','_',$category->title).'/'.$model->url));
               Models::destroy($model->id);
           }
        }
        Marker::destroy($category->id);
        \Session::flash('delcat', 'Markers  Deleted Successfully  !');
        return redirect('admin/markers');
    }
    function del_model(){
        $id=$_GET['id'];
        $model = Models::findOrFail($id);
        $marker = Marker::findOrFail($id);
        unlink(url('models/'.str_replace(' ','_',$marker->title).'/'.$model->url));
        Models::destroy($id);

        \Session::flash('delcat', 'Markers  Deleted Successfully  !');
        return redirect()->back();
    }



}
