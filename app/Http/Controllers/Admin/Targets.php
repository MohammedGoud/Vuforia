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


        echo "<pre>";
        var_dump($vws->getTargets());
        echo "</pre>";


    }




}
