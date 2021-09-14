<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OneToManyController extends Controller
{
    public function createOrder(){
        $users=User::all();
        return view('OneToManyRelation.create_order')->with('users',$users);
    }

}
