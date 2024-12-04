<?php

namespace App\Http\Controllers\Api;

use App\Models\user;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
            'role'      => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'      => $request->role
        ]);

        //return response JSON user is created
        if($user) {
            return response()->json([
                'status' => true,
                'message' => 'Pengguna berhasil ditambahkan',
                'data'    => $user,  
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'status' => false,
            'message' => 'Pengguna gagal ditambahkan',
        ], 409);

    }

    
}
