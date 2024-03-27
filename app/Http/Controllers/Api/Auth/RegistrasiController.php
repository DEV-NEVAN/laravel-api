<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
    	$request->validate([
    		'name' => ['required','min:3'],
    		'email' => ['required','email','unique:users,email'],
    		'password' => ['required','min:8']
    	]);

        $register = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => Hash::make($request->password)

        ]);

        $token = $register->createToken('todo-api')->plainTextToken;

        return response()->json([
        	'token' => $token
        ]);
    }
}
