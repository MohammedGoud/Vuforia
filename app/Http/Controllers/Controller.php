<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Log;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function insertlog($name,$action,$markid,$markname){
        $category = new Log;
        $user=\Session::get('adminid');
        $category->user_id = $user;
        $category->name = $name;
        $category->marker_id = $markid;
        $category->marker_name = $markname;
        $category->action = $action;
        $category->save();
    }
}

