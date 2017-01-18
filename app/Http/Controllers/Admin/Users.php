<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Input;
use Form;
use App\Http\Controllers\Controller;

class Users extends Controller
{
    public function __construct()
    {
        $this->middleware('adminmiddleware');
    }
    public function index()
    {
        $categories = User::orderBy('id', 'DESC')->get();
        return view('admin.users.index',['categories'=>$categories]);

    }

    public function create()
    {

        $categories_parent = Category::where('category_parent', '0')->get();
        $categories_types = Type::All();
        return view('admin.categories.add',['cats'=>$categories_parent ,'types'=>$categories_types]);
        //
    }


    public function store(Request $request)
    {

//        $this->validate($request, [
//            'email' => 'required | unique:users1,user_email| Email',
//            'phone' => 'required | unique:users1,user_phone',
//            'password1' => 'required |Between:5,10 ',
//            'password2' => 'required |Same:password1| Between:5,10'
//        ]);
//


        $path = public_path() . '/assets/images/categories/';
        $category = new Category;
        $type = new Categorytype;
        $category->category_name = $request->cat_en;
        $category->category_names = $request->cat_ar;
        $category->tetle_web = $request->seo;
        $category->description = $request->desc_en;
        $category->descriptionar = $request->desc_ar;
        $category->keywords = $request->key_en;
        $category->keywordsar = $request->key_ar;
        //$category->category_parent = $request->parent;
        $category->category_order = $request->order;
        $category->icon = $request->icon;
        $category->category_parent = ($request->subcategory!=''?$request->subcategory:$request->parent);
        $category->status = ($request->status=='on')?1:0;


//        $file = Input::file('image');
//
//        $imageTempName = $file->getPathname();
//        $imageName = $file->getClientOriginalName();
//        $file->move($path, $imageName);
//        $new_file=explode('.',$imageName);
//        $ext=Input::file('image')->getClientOriginalExtension();
//        $new_image=strtolower(str_random(15)).'.'.$ext;
//        rename($path.$imageName,$path.$new_image);
//        $category->category_images = $new_image;
        $category->save();
        $types=implode(',',$request->types);
        $type->cat_id = $category->category_id;
        $type->types_ids =$types;
        $type->save();
        \Session::flash('addcat', 'Category  Add Successfully  !');
        return redirect('mzadqater_admin/categories');

    }
    public function destroy($id){

        Category::destroy($id);
        \Session::flash('delcat', 'Category  Deleted Successfully  !');
        return redirect('mzadqater_admin/categories');
    }
    public function activate(Request $request,$id){

        $category = Category::findOrFail($id);
        $category->status = 1;
        $category->save();
        \Session::flash('activate', 'Category  Activated Successfully  !');
        return redirect('mzadqater_admin/categories');
    }
    public function deactivate(Request $request,$id){

        $category = Category::findOrFail($id);
        $category->status = 0;
        $category->save();
        \Session::flash('deactivate', 'Category  Deactivated Successfully  !');
        return redirect('mzadqater_admin/categories');
    }

    public function edit($id)
    {

        $categories_parent = Category::where('category_parent', '0')->get();
        $categories_types =  Categorytype::where('cat_id', $id)->first();
        $categories_types_all = Type::All();
        $category_details = Category::findOrFail($id);
        $types_array=explode(',',$categories_types['types_ids']);
        return view('admin.categories.edit',['cats'=>$categories_parent ,'types'=>$categories_types_all,'details'=>$category_details,'cat_types'=>$types_array]);
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
        $category = Category::findOrFail($id);
        $type = Categorytype::where('cat_id', $id)->first();
        $category->category_name = $request->cat_en;
        $category->category_names = $request->cat_ar;
        $category->tetle_web = $request->seo;
        $category->description = strip_tags($request->desc_en);
        $category->descriptionar = strip_tags($request->desc_ar);
        $category->keywords = $request->key_en;
        $category->keywordsar = $request->key_ar;
        $category->icon = $request->icon;
        $category->category_parent = $request->parent;
        $category->category_order = $request->order;
        $category->status = ($request->status=='on')?1:0;
        $category->save();
        $types=implode(',',$request->types);
        if($type==null){
            $type =new  Categorytype;
            $type->cat_id = $id;
            $type->types_ids =$types;
            $type->save();
        }else {
            $type->cat_id = $id;
            $type->types_ids = $types;
            $type->save();
        }

        \Session::flash('updatecat', 'Category  Updated Successfully  !');
        return redirect('mzadqater_admin/categories');
    }


    function get_categories(Request $request){
        if ($request->ajax())
        {
            $string=' <option value="">SubCategory   </option> ';
            $cat_id=$request->input('category');
            $categories = DB::table('categoriess')->where('category_parent','=',$cat_id)->where('category_parent','<>',0)->get();
            foreach ($categories as $category) {
                $string .= '<option value='.$category->category_id.'>'.$category->category_name. '  ' .$category->category_names .'</option> ';

            }

            $string.='';
            return $string;


        }

    }


}
