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


        //var_dump($vws->getTarget('2541103895ed401eb199c5d7c825e856'));

//$arr=array ( [status] => 201 [body] => {"result_code":"TargetCreated","transaction_id":"6a393cfa920e499bb99e7b1a70d44669","target_id":"218d81352653460d99705b170d76f888"} )


        //var_dump($vws->getTargets());

        //print_r($tar['body']);
        //$vws->deleteTarget('a5a1f6891785413a8987bc345f52d87d');
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

    public function store(Request $request,VuforiaWebService $vws)
    {

        $category = new Marker;

        $category->project_id = $request->project_id;
        $category->lat = $request->lat;
        $category->lng = $request->long;
        $category->title = $request->name;
        $modeles=array();
        $modeles[]=array('lat'=>$request->lat,'long'=>$request->long);

        if($request->hasFile('model')) {
            $path = public_path() . '/models/'.str_replace(' ','_',$request->name).'/';
            $files = Input::file('model');
            foreach ($files as $file) {
                $imageName = $file->getClientOriginalName();
                $file->move($path, $imageName);
                $modeles[]=array('url'=>url('/models/'.str_replace(' ','_',$request->name).'/'.$imageName));

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
            $modeles[]=array('image360'=>url('/360/'.$new_image));
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
            $modeles[]=array('video360'=>url('/360/'.$new_image));
        }
        $data=array('data'=>$modeles);
        $new_meta=json_encode($data);
        dd(stripslashes($new_meta));
        if(!empty($modeles)){
            $medta=stripslashes($new_meta);
            $category->meta_data = $data;
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
            $category->target_id = $atgg->target_id;



        }





        $category->save();
        \Session::flash('addcat', 'Markers  Add Successfully  !');
        return redirect('admin/markers?id='.$request->project_id);

    }
      public function update(Request $request, $id,VuforiaWebService $vws)
    {
        $category = Marker::findOrFail($id);
        $category->project_id = $request->project_id;
        $category->title = $request->name;



        $modeles=array();
        if($request->hasFile('model')) {
            $path = public_path() . '/models/'.str_replace(' ','_',$request->name).'/';
            $files = Input::file('model');
            foreach ($files as $file) {
                $imageName = $file->getClientOriginalName();
                $file->move($path, $imageName);
                $ext = $file->getClientOriginalExtension();
                $new_image = strtolower(str_random(15)) . '.' . $ext;
                $modeles[]=array('url'=>url('/models/'.str_replace(' ','_',$request->name).'/'.$imageName));
                //rename($path . $imageName, $path . $new_image);
            }


        }
        $data=array('data'=>$modeles);
        $new_meta=json_encode($data);
        if(!empty($modeles)){
            $medta=stripslashes($new_meta);
            $category->meta_data = $data;
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
            $vws->updateTarget($category->target_id,
                ['name' => str_replace(' ','_',$request->name),
                'width' => 150,
                'path' => url('markers/' . $new_image),
                'metadata'=>$medta
            ]);

        }


        $category->save();
        \Session::flash('updatecat', 'Markers  Updated Successfully  !');
        return redirect('admin/markers?id='.$request->project_id);
       }
       public function destroy($id,VuforiaWebService $vws){
        $category = Marker::findOrFail($id);
        $vws->deleteTarget($category->target_id);
        Marker::destroy($category->id);
        \Session::flash('delcat', 'Markers  Deleted Successfully  !');
        return redirect('admin/markers');
    }
    public function edit($id)
    {

        $category = Marker::findOrFail($id);
        return view('admin.markers.edit',['project'=>$category]);
        //
    }



}
