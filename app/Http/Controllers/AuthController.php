<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    use ApiResponser;

    public function __construct() {
    }

    public function login(Request $request)
    {
        // dd($request->user());
        $request->validate([
            'email' => 'required|string|email',// correo electronico
            'password' => 'required|string',// contraseña
            //'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) return $this->errorResponse('Unauthorized',Response::HTTP_UNAUTHORIZED);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return $this->succesResponse([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string', //nombres
            'last_name' => 'required|string', //apellidos
            'username' => 'required|string', //apellidos
            'email' => 'required|string|email|unique:users',//correo electronico
            'password' => 'required|string'//contraseña
        ]);
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->succesResponse($user, Response::HTTP_CREATED);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


}
