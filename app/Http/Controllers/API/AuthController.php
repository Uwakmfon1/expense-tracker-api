<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Cassandra\Time;
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
       $result = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $result['email_verified_at'] = now();
        $result['created_at'] = now();
        $result['updated_at'] = now();
        $result['password'] = bcrypt($result['password']);
        
        try {
            User::create($result);
            return response()->json(['message'=>'successfully saved to database'],201);
        } catch (\Exception $e) {
            return response()->json(['message'=>'could not save to database']);
        }
    }


    public function login()
    {

    }
}
