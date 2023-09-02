<?php
namespace App\Http\Controllers;

use App\Models\Proyect;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function register(Request $request)
    {

        try {
            $this->validate($request, [
                'email' => 'required|email|string|unique:users',
                'password' => 'required|min:8',
                'year_of_birth' => 'required|numeric',
                'last_name' => 'required|string',
                'name' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->year_of_birth = $request->year_of_birth;
        $user->last_name = $request->last_name;
        $user->name = $request->name;
        $user->save();
        $token= $user-> createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
             $user = User::where('email',$request['email'])->firstOrFail();
             $token= $user-> createToken('auth_token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        return ['message'=>'Succesful sesion close'];
    }
}
