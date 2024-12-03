<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

//use \Auth

class AuthController extends Controller
{

    /**
    8. API Endpoints
    User Management
    POST /signup: Register a new user.

    POST /login: Authenticate a user.

    GET /profile: Retrieve user profile details.

    PUT /profile: Update user profile information.

     *
    Expense and Income Logging
    POST /transactions: Log a new expense or income.

    GET /transactions: Retrieve all transactions for a specific user.

    PUT /transactions/{id}: Update an existing transaction.

    DELETE /transactions/{id}: Delete a transaction.


     * Budget Management
    POST /budgets: Set a new budget for a category.

    GET /budgets: Retrieve budget details for a user.

    PUT /budgets/{id}: Update an existing budget.

    DELETE /budgets/{id}: Delete a budget.


    Savings Goals
    POST /goals: Set a new savings goal.

    GET /goals: Retrieve all savings goals for a user.

    PUT /goals/{id}: Update a savings goal.

    DELETE /goals/{id}: Delete a savings goal.
     */

    public function index()
    {
        return response()->json(['message'=>'welcome to my Api']);
    }


    public function register(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string'
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
        return response()->json([
            'message' => 'successfully saved to database',
            'accessToken' => $accessToken
        ], 201);
    }


    public function login(Request $request)
    {
   $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

 if (Auth::attempt($credentials)) {
     $user = Auth::user();
     $token = $user->createToken($user->name .'authToken')->plainTextToken;



        return response()->json([
            'token'=>$token,
            'message' => 'user logged in successfully '
        ], 200);
    }

        return response()->json([
            'error'=>'Invalid Credentials'
        ],400);


//           if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password])) {
//               $user = Auth::user();
//               $token = $user->createToken('API Token')->accessToken;
//
//               // Return the token in a successful response
//               return response()->json([
//                   'token' => $token,
//                   'message' => 'user logged in successfully '
//               ], 200);
//           }

//               return response()->json([
//                   'error'=>'Invalid Credentials'
//               ],400);


//        }catch(\Exception $e){
//            return response()->json([
//                'message'=>"An error occurred while trying to validate details",
//                'error'=>$e->getMessage(),
//            ],500);

//        }



    }

    public function getInfo(Request $request)
    {
        $result  = $request->validate(['email'=>'required|email']);

        try{
            if(!$result){
                return response()->json(['message'=>'An error occurred'],401);
            }
            return response()->json(User::where('email',$result['email'])->all());

        }catch (\Exception $e){
            return response()->json([
                'message'=>"An error occurred while trying to validate details",
                'error'=>$e->getMessage(),
            ],500);
        }
    }
}
