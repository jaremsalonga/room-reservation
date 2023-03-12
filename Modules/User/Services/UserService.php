<?php

namespace Modules\User\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\User\Repositories\Interfaces\UserInterface;

class UserService {

    public function __construct(protected UserInterface $userRepository) {}

    public function store(Request $request) {
        
        $validateUser = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $user = $this->userRepository->store([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'token' => $user->createToken(env('API_TOKEN'))->plainTextToken
        ], 200);
    }

    public function index() {
        return $this->userRepository->index();
    }

    public function show(string $id) {
        return $this->userRepository->show($id);
    }

    public function destroy(string $id) {
        return $this->userRepository->destroy($id);
    }

    public function logIn(Request $request) {

        $validateUser = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = $this->userRepository->findByKeyAndValue('email', $request->email);

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken(env('API_TOKEN'))->plainTextToken
        ], 200);
    }
}