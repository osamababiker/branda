<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;

class authController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'     => 'required|string',
            'username' => 'required|string',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->passes()) {
          $code = rand(1000, 9999); //generate random code

          $user = new User([
              'name'      => $request->name,
              'username'  => $request->username,
              'email'     => $request->email,
              'phone'     => $request->phone,
              'verifi_code' => $code,
              'password'  => Hash::make($request->password),
              'status' => 1
          ]);
          $user->save();
          return response()->json([
              'code' => 200,
              'message' => 'Successfully created user!'
          ]);
        }
        return response()->json([
          'code' => 400,
          'error'=>$validator->errors()->all()
        ]);

    }

    public function test(Request $request){

       $client = new \GuzzleHttp\Client();
       $response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

       return response()->json($response->getStatusCode());
       //echo $response->getStatusCode(); // 200
       //echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
       //echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
   }

    public function verifiction($code,$user_id){
        $user = User::find($user_id);
        if($code == $user->verifi_code){
            User::where('id',$user_id)->update([
                'verifi_code' => '',
                'phone_verified' => 'true'
            ]);

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            return response()->json([
                'user' => $user,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'status' => 1
            ], 201);
        }
        else{
            return response()->json([
                'status' => 0
            ], 201);
        }
    }


    public function login(Request $request)
   {
       $request->validate([
           'phone' => 'required|string',
           'password' => 'required|string',
           'remember_me' => 'boolean'
       ]);
       $credentials = request(['phone', 'password']);
       if(!Auth::attempt($credentials))
           return response()->json([
               'code' => 401,
               'message' => 'Unauthorized'
           ]);


       $user = $request->user();
       if($user->phone_verified == 'true'){
           $tokenResult = $user->createToken('Personal Access Token');
           $token = $tokenResult->token;
           if ($request->remember_me)
               $token->expires_at = Carbon::now()->addWeeks(1);
           $token->save();
           return response()->json([
               'user' => $user,
               'access_token' => $tokenResult->accessToken,
               'token_type' => 'Bearer',
               'expires_at' => Carbon::parse(
                   $tokenResult->token->expires_at
               )->toDateTimeString()
           ]);
       }
       else{
           return response()->json([
               'code' => 401,
               'message' => 'Unverified'
           ]);
       }


   }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }



}
