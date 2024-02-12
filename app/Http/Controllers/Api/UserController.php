<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function all()
    {
        return response()->json([
            'status' => true,
            'message' => "Data ditemukan User",
            'data' => User::all(),
        ]);
    }

    public function login(Request $request)
    {

        $loginValidate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], ['email' => 'harus diisi dengan alamat email yang valid.',]);

        if ($loginValidate->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Data ada yang salah",
                'data' => $loginValidate->errors(),
            ]);
        }

        $dataUser = User::where('email', $request->email)->first();
        if (empty($dataUser)) {
            return response()->json([
                'status' => false,
                'message' => "Email tidak ditemukan",
                'data' => null,
            ]);
        }

        if (!Hash::check($request->password, $dataUser->password)) {
            return response()->json(['status' => false, 'message' => 'Login Fail, please check password']);
        }


        return response()->json([
            'status' => true,
            'message' => 'Sukses Login',
            'data' => [
                'id' => $dataUser->id,
                'name' => $dataUser->name,
            ],

        ]);
    }
}
