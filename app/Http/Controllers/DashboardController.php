<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $year = ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AUG','SEPT','NOV','DES'];

        $user = ['25','19','45'];
        // foreach ($year as $key => $value) {
        //     $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        // }

    	return view('dashboard.index')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
        // return view('');
    }
}
