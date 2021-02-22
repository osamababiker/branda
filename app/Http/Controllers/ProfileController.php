<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class ProfileController extends Controller
{
    public function index(){

    }

    public function update(Request $request){
      
      $validator = Validator::make($request->all(),[
          'name'     => 'required|string',
          'username' => 'required|string',
          'email'    => 'required|email|unique:users',
          'phone'    => 'required|string|unique:users',
      ]);

      if($validator->passes()){
        User::where('id',$request->user_id)->update([
          'name' => $request->name,
          'username' => $request->username,
          'email' => $request->email,
          'phone' => $request->phone
        ]);

        return response()->json([
          'code' => 200,
          'message' => 'تم تحديث بيانات المستخدم بنجاح'
        ]);
      }
      return response()->json([
        'code' => 400,
        'error'=>$validator->errors()->all()
      ]);
    }
}
