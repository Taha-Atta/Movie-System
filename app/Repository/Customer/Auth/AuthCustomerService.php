<?php

namespace App\Repository\Customer\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\Customer\Auth\ILoginCustomerInterface;




class AuthCustomerService implements IRegisterCustomerInterface,ILoginCustomerInterface,ILogoutCustomerInterface {
    public function CustomerRegister($request){
        $date = $request->all();

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'age'=>$request->age,
            'type'=>$request->type,
        ]);
      return $user;


    }

    public function CustomerLogin($request){

        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'msg' => 'invalid password or email',
            ], 403);
        }

        // $user = Auth::user();
      $user = User::where('email',$request['email'])->firstOrFail();
        $token = $user->createToken('token-name')->plainTextToken;

        $data['token'] = $token;
        $data['user'] = $user['name'];
        return $data;
    }



    public function CustomerLogout($request){

        $request->user()->tokens()->delete();
    }
}