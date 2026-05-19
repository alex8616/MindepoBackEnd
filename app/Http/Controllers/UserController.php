<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function GetUserFull(){
        $users = User::Get();
        return response()->json($users);
    }
}
