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
        $user=\Session::get('adminid');
        $role=\Session::get('adminrole');
        if($role!='admin') {
            $categories = Marker::where('user_id', '=', $user)->orderBy('id', 'ASC')->get();
        }
        else{
            $categories = Marker::orderBy('id', 'ASC')->get();
        }
            return view('admin.markers.index',['categories'=>$categories]);

    }

    public function create()
    {


        return view('admin.markers.add');
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
        $user=\Session::get('adminid');
        $category->user_id = $user;
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
        $medta='';
        if(!empty($modeles)){
            $medta=stripslashes($new_meta);
        }else{
            $medta=$request->meta_data;
        }
        $category->meta_data = $request->meta_data;
        if($request->hasFile('image')) {
            $path = public_path() . '/markers/';
            $file = Input::file('image');
            $imageName = $file->getClientOriginalName();
            $file->move($path, $imageName);
            $ext = Input::file('image')->getClientOriginalExtension();
            $new_image = strtolower(str_random(15)) . '.' . $ext;
            rename($path . $imageName, $path . $new_image);
            $category->url = $new_image;
            dd($medta);
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
        $this->insertlog( \Session::get('name'),'Add New Marker',$category->id,$request->name);
        if(!empty($models3d)) {
            for ($i = 0; $i < count($models3d); $i++) {
                $model = new Models;
                $model->marker_id = $marker_id;
                $model->url = $models3d[$i];
                $model->save();
            }
        }
        \Session::flash('addcat', 'Markers  Add Successfully  !');
        return redirect('admin/markers');
    }
    public function update(Request $request, $id,VuforiaWebService $vws)
    {
        $category = Marker::findOrFail($id);
        $user=\Session::get('adminid');
        $category->user_id = $user;
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

        }else{
            $medta=$request->meta_data;

        }
        $category->meta_data = $request->meta_data;

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
        $this->insertlog( \Session::get('name'),'Update  Marker',$id,$request->name);
        if(!empty($models3d)) {
            for ($i = 0; $i < count($models3d); $i++) {
                $model = new Models;
                $model->marker_id = $marker_id;
                $model->url = $models3d[$i];
                $model->save();
            }
        }
        \Session::flash('addcat', 'Markers  Add Successfully  !');
        return redirect('admin/markers');
       }
    public function destroy($id,VuforiaWebService $vws){
        $category = Marker::findOrFail($id);
        $this->insertlog( \Session::get('name'),'Remove  Marker',$id,$category->title);
        $models = Models::where('marker_id',$category->id)->first();
        $vws->deleteTarget($category->vws_id);

        if($category->url!=null){

            unlink(public_path('/markers/'.$category->url));
        }
        if($category->image360!=null){
            unlink(public_path('/360/'.$category->image360));
        }
        if($category->video360!=null){
            unlink(public_path('/360/'.$category->video360));
        }

        if(!empty($models) && $models!=null){
           foreach($models as $model){
               unlink(public_path('models/'.str_replace(' ','_',$category->title).'/'.$model->url));
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
        public_path(url('models/'.str_replace(' ','_',$marker->title).'/'.$model->url));
        Models::destroy($id);

        \Session::flash('delcat', 'Markers  Deleted Successfully  !');
        return redirect()->back();
    }



}
