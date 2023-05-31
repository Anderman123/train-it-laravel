<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use App\Models\User;
//use App\Models\Role;
use App\Http\Resources\UserResource;

class TokenController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function index() 
    {
        $users = User::all();
        return UserResource::collection($users);
    }
    
    public function changeUserRole(Request $request, $userId)
    {
        // Verificar que el usuario autenticado es un admin
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Buscar al usuario
        $user = User::findOrFail($userId);

        // Cambiar el role del usuario
        $user->role = $request->input('role');
        $user->save();

        return response()->json([
            'success' => true,
            'user' => new UserResource($user),
            'role' => $user->role,  // Incluye el nuevo rol
        ]);
    }
    

    public function register(Request $request) 
    {
        $validatedData = $request->validate([
            "name"      => "required|string|max:255",
            "email"     => "required|string|email|max:255|unique:users",
            "password"  => "required|string|min:8"
        ]);
        
        $user = User::create([
            "name"      => $validatedData["name"],
            "email"     => $validatedData["email"],
            "password"  => Hash::make($validatedData["password"]),
            "role"      => "user",
        ]);
        
       // $user->assignRole(Role::AUTHOR);

        // event(new \Illuminate\Auth\Events\Registered($user));
        
        // $user->sendEmailVerificationNotification();

        return $this->_generateTokenResponse($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            // Get user
            $user = User::where([
                ["email", "=", $credentials["email"]]
            ])->firstOrFail();
            // Revoke all old tokens
            $user->tokens()->delete();
            // Generate new token
            $token = $user->createToken("authToken")->plainTextToken;
            // Token response
            return response()->json([
                "success"   => true,
                "authToken" => $token,
                "tokenType" => "Bearer",
                "user" => [
                    "id" => $user->id, // Aquí se agrega el ID del usuario a la respuesta
                    "role" => $user->role, // Aquí se agrega el role del usuario a la respuesta
                ],
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Invalid login credentials"
            ], 401);
        }
    }
    
    public function user(Request $request) 
    {
        $user = User::where('email', $request->user()->email)->first();

        return response()->json([
            "success" => true,
            "user"    => new UserResource($user),
            //"roles"   => $user->getRoleNames(),
        ]);
    }

    public function logout(Request $request) 
    {
        // Revoke token used to authenticate current request...
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "success" => true,
            "message" => "Current token revoked",
        ]);
    }

    protected function _generateTokenResponse(User $user)
    {
        $token = $user->createToken("authToken")->plainTextToken;

        return response()->json([
            "success"   => true,
            "authToken" => $token,
            "tokenType" => "Bearer"
        ], 200);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Revoke all tokens
        $user->tokens()->delete();
    
        $user->delete();
    
        return response()->json([
            "success" => true,
            "message" => "User deleted",
        ], 200);
    }

}