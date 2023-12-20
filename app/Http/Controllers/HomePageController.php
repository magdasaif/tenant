<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index(){
        // dd(DB::getDefaultConnection());
        $users=User::get();
        return view('welcome',compact('users'));
    }
}
