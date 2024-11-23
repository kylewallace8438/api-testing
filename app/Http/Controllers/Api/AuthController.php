<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Eloquent\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function createUser(Request $request)
    {
        try {
            $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $verified_email = false;
            return response()->json([
                'verified_email' => $verified_email
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Unauthorized'
                ]);
            }

            $user = $this->userRepository->findByEmail($credentials['email']);

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('api')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }

    public function getUser(Request $request)
    {
        try {
            return $request->user();
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in getting user',
                'error' => $e,
            ]);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $loggedUserID = $request->user()->id;
            $this->userRepository->update($loggedUserID, [
                'name' => $request->get('name'),
            ]);
            $user = $this->userRepository->detail($loggedUserID);
            return response()->json([
                'status_code' => 200,
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in updating user',
                'error' => $e,
            ]);
        }
    }
}
