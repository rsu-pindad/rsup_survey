<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\RedirectResponse;

class RegisterController extends BaseController
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error , ' . $validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::created($input);
        $success['token'] = $user->createToken('AuthToken')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User registrasi berhasil.');
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('AuthToken')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'Selamat datang ' . $user->name . '.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
        // return $this->redirectRoute('login');
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        try {
            // Revoke all tokens for the authenticated user
            // $user->tokens()->delete();
            $user->currentAccessToken()->delete();
        } catch (\Exception $e) {
            // Log the exception for investigation
            Log::error('Token revocation failed: ' . $e->getMessage());
            // return response()->json(['error' => 'Unable to revoke tokens'], 500);
        }
        // return $this->redirectRoute('login');
        return response()->json(['message' => 'Tokens revoked successfully']);
        // return redirect()->route('login');
    }
}
