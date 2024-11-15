<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
//use \Auth

class AuthController extends Controller
{

    public function index()
    {
        return response()->json(['message'=>'welcome to my Api']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
//        $user->verified_at =
        $user->save();
//        try {
//            User::create($result);
//            return response()->json(['message'=>'successfully saved to database'],201);
//        } catch (\Exception $e) {
//            return response()->json(['message'=>'could not save to database']);
//        }
    }


    public function login()
    {

    }
}
