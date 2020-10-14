<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request->email)->firstOrFail();
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;

        if($user){
            if(Hash::check($request->password, $user->password)){
                $user->generateToken();
                $status = "success";
                $message = "login sukses";
                $data = $user->toArray();
                $code = 200;
            }
            else {
                $message = "login gagal , password salah";
            }
            return response()->json([
                "status" => $status,
                "message" => $message,
                "data" => $data
            ], $code); 
        }

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'username' => 'required|string|min:6|unique:users'
        ]);

        if($validator->fails()){
            // validasi gagal
            $errors = $validator->errors();
            return response()->json([
                'data' => [
                    'message' => $errors,
                ]
            ], 400);
        }
        else {
            // validasi berhasil
            $user = new User;
            $user->username = $request->username;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;

            if($user) {
                $user->generateToken();
                $status = "success";
                $message = "register successfully";
                $data = $user->toArray();
                $code = 200;
            }
            else {
                $message = "register failed";
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'logout berhasil',
            'data' => null
        ], 200);
    }
}
