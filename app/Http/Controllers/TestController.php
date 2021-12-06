<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function delete_user(Request $request){
        User::where("email","teste@gmail.com")->delete();
        print 'deletado';
    }
}
