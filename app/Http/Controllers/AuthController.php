<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Identity;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $credentials = [
            'email' => $request->json('email'),
            'password' => $request->json('password'),
        ];

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth()->user();
        // Obtener información de identity si existe
        $identity = Identity::where('uuid', $user->uuid)->first();

        return $this->respondWithToken($token, $user,  $identity);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user,  $identity)
    {
        return response()->json([
            'status' => true,
            'code'=> 200,
            "message" =>"Usuario autenticado exitosamente.",
            'token' => $token,
            'identity' => $identity,
            // 'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            // 'user_info' => $user,
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'name' => 'required',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Generar UUID para el usuario e identidad
        $uuid = Str::uuid()->toString();

        $user = User::create(array_merge(
            $validator->validate(),
            [
                'password' => bcrypt($request->json('password')),
                'uuid' => $uuid,
            ]
        ));

        // Definir $currentTimestamp solo si la validación es exitosa
        $currentTimestamp = time();

        $identity = new Identity([
            'iss' => 'http://test.gosice.com',
            'sub' => 'Authentication',
            'aud' => 'http://186.70.111.82',
            'typ' => 'json',
            'uuid' => $uuid,
            'name' => 'PRUEBA',
            'surname' => 'DESARROLLO',
            'email' => $request->json('email'),  // Utilizando el correo electrónico del usuario
            'avatar' => 'http://test.gosice.com/resources/images/avatar.png',
            'iat' => $currentTimestamp,
            'exp' => $currentTimestamp + 3600,  // Agregar 1 hora al timestamp actual (3600 segundos)
        ]);

        $identity->save();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'identity' => $identity,
        ], 201);
    }

//     public function register(Request $request)
// {
//     $validator = Validator::make($request->json()->all(), [
//         'name' => 'required',
//         'email' => 'required|string|email|max:100|unique:users',
//         'password' => 'required|string|min:6',
//     ]);

//     if ($validator->fails()) {
//         return response()->json($validator->errors()->toJson(), 400);
//     }

//     $user = User::create(array_merge(
//         $validator->validate(),
//         ['password' => bcrypt($request->json('password'))]
//     ));

//     $identity = new Identity([
//         'iss' => 'http://test.gosice.com',
//         'sub' => 'Authentication',
//         'aud' => 'http://186.70.111.82',
//         'typ' => 'json',
//         'uuid' => '6bf10012-4890-42f0-b8ed-cd6f5f0f082e',
//         'name' => 'PRUEBA',
//         'surname' => 'DESARROLLO',
//         'email' => 'prueba@gotrade.com.ec',
//         'avatar' => 'http://test.gosice.com/resources/images/avatar.png',
//         'iat' => 1705982747,
//         'exp' => 1706587547,
//     ]);

//     return response()->json([
//         'message' => 'User created successfully',
//         'user' => $user,
//     ], 201);
// }


}
