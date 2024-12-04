<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class user1Controller extends Controller
{
    public function cu1(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }

        $save = User::create([
            'name'    =>$req->get('name'),
            'username'        =>$req->get('username'),
            'password'        =>bcrypt($req->get('password')),
            'role'        =>$req->get('role'),
        ]);
        if($save){
            return Response()->
            json([
                'status'=>true,
                'message' => 'Pengguna berhasil ditambahkan',
                'data'=>$save]);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Pengguna gagal ditambahkan']);
     }

    }

        public function updateuser(Request $req, $id)
    {
        $validaator = Validator::make($req->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
    ]);

    if($validaator->fails()){
        return response()->json($validaator->errors(),400);
    }

    $user = User::find($id);

    if(!$user) {
        return response()->json(['status'=>false, 'message'=>'User tidak ditemukan'],404);
    }

    $user->update($req->only([
        'name','username',bcrypt('password'),'role'
    ]));

    if($user){
        return Response()->json([
            'status'=>true,
            'message' => 'Sukses update user',
            'data' => $user
        ]);
    }else {
        return Response()->json(['status'=>false, 'message' => 'Gagal update user']);
 }
    }

    public function show($id) {
        $siswa = User::find($id);
        return response()->json(['status'=>true, 'data' => $siswa]);
    }

    public function d1($id){
        $user=user::find($id);
        if(!$user){
            return response()->json(['status'=>false, 'message'=> "User dengan id $id tidak ditemukan"],404);
        }
        $user->delete();
        return response()->json(['status'=>true, 'message'=>'User berhasil dihapus']);
    }
}
