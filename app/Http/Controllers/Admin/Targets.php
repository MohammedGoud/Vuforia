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


class Targets extends Controller
{
    public function __construct()
    {
        $this->middleware('adminmiddleware');
    }
    public function index(VuforiaWebService $vws)
    {

       $id=$_GET['id'];
        echo "<pre>";
        print_r($vws->getTarget('3862212494bc4c1bbe9152c2bbb59952'));
        echo "<pre>";


    }




}
