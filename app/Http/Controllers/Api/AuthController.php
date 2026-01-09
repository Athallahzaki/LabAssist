<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * LOGIN
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password Salah!'],
            ]);
        }

        $user = $request->user();

        // Optional: block inactive users
        if (!$user->is_active) {
            Auth::logout();

            return response()->json([
                'message' => 'Akun tidak aktif',
            ], 403);
        }

        // Create API token
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login Berhasil!',
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * REGISTER
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nim' => 'required|unique:students,nim',
            'class' => 'required',
        ]);

        $studentRole = Role::where('role_code', Role::STUDENT_CODE)->firstOrFail();

        $user = DB::transaction(function () use ($request, $studentRole) {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $studentRole->id,
                'is_active' => true,
            ]);

            Student::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'display_name' => $request->username,
                'class' => $request->class,
            ]);

            return $user;
        });

        // Auto-login after register
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi Berhasil!',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Berhasil!',
        ]);
    }
}
