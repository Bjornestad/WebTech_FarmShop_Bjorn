<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function userInformation(){
        $users = DB::table('users')->select('name','email','phoneNumber')->get();

        return view('userpage',['userData'=>$users]);
    }


}

