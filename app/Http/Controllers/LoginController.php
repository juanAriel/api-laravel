<?php

namespace App\Http\Controllers;

use App\helpers\AbilitiesResolver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $abilities = AbilitiesResolver::resolve($user, $request->device);
            // $abilities = $this->resolveAbilities($user, $request->device);
            $token = $user->createToken('login', $abilities);

            return [
                'token' => $token->plainTextToken,
            ];
        }
        return response()->json([
            'message' => 'Invalid Credentials',
        ], 401);
    }
}
