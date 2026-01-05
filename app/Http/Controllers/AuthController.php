<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            return $user->createToken('user_login')->plainTextToken;
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal login',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'Berhasil logout',
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Gagal logout',
                'error' => $th->getMessage()
            ]);
        }
    }
    public function lihat(Request $request)
    {
        return response()->json([
            'message' => 'Anda sudah login',
            'data' => $request->user(),
        ]);
    }

    public function cekapi()
    {
        try {
            return response()->json([
                'status'=>'true',
                'message'=>'API telah tersambung',
                'server-time'=>now()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'false',
                'message'=>'API'
            ]);
        }
    }
}
