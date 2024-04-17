<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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
            return $this->sendError('Unauthotrised.', ['error' => 'Unauthorised']);
        }
    }
}
