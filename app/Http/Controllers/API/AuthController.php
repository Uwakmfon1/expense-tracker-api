<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

//use \Auth

class AuthController extends Controller
{

    public function index()
    {
        return response()->json(['message'=>'welcome to my Api']);
    }


    public function register(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'=>'could not save to database',
                'errors'=> $validator->errors()->all()
            ], 401);
        }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'email_verified_at'=>now(),
            'created_at'=> now(),
            'updated_at'=> now(),
            'password'=> bcrypt($request->password)
        ]);



        $accessToken = $user->createToken($request->name . 'authToken')->plainTextToken;
        Log::info('User created successfully',['accessToken'=>$accessToken]);

        return response()->json([
            'message' => 'User created successfully',
            'accessToken' => $accessToken
        ], 201);
    }


    public function login(Request $request)
    {
         $validated_user = $request->validate([
                'email' => ['required','email'],
                'password' => ['required']
         ]);

        $user = User::where('email', $validated_user['email'])->first();

        if (!$user || !Hash::check($validated_user['password'], $user->password)) {
            $errors = [];
            if(!$user) $errors['email'] = "Please supply a valid email address";

            if($user && !Hash::check($validated_user['password'], $user->password)) $errors['password']= "Incorrect Password";

            Log::error('Invalid credentials attempt', [
                'email' => $validated_user['email'],
            ]);

            return response()->json([
                'message' => 'Invalid Credentials',
                'error'=>$errors,
            ],422);
        }

        $user->tokens()->delete();
        $token = $user->createToken($user->name .'authToken')->plainTextToken;
        return response()->json([
            'message'=>'Successfully logged in',
            'access_token'=>$token
        ],200);
    }


    public function getInfo(Request $request)
    {
        $result  = $request->validate(['email'=>'required|email']);
        try{
            return response()->json(User::where('email',$result['email'])->first());

        }catch (\Exception $e){
            return response()->json([
                'message'=>"An error occurred while trying to validate details",
                'error'=>$e->getMessage(),
            ],500);
        }
    }

    public function logout(Request $request)
    {
        try{
            $request->user()->tokens()->delete();
            return response()->json(['successfully logged out'],200);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'error'=>$e->getMessage()],400);
        }
    }
}
