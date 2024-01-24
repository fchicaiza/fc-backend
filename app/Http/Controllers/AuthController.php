<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Identity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Utilities\HttpResponse;

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
        try {
            $validator = Validator::make($request->json()->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Exception('Su nombre de usuario o clave de acceso son incorrectos o su cuenta de usuario no existe.', 401);
            }

            $credentials = [
                'email' => $request->json('email'),
                'password' => $request->json('password'),
            ];

            if (! $token = auth()->attempt($credentials)) {
                throw new \Exception('Su nombre de usuario o clave de acceso son incorrectos o su cuenta de usuario no existe.', 401);
            }

            $user = auth()->user();
            // Obtener información de identity si existe
            $identity = Identity::where('uuid', $user->uuid)->first();

            return $this->respondWithToken($token, $user,  $identity);
        } catch (\Exception $e) {
            return response()->json([
                'status' => HttpResponse::clientError()['status'],
                'code' => HttpResponse::clientError()['code'],
                'message' => $e->getMessage(),
                'token' => null,
                'identity' => null,
            ], $e->getCode());
        }
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

        return response()->json(['message' => 'Sesión cerrada exitosamente']);
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
            'status' => HttpResponse::success()['status'],
            'code' =>   HttpResponse::success()['code'],
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
        try {
            $validator = Validator::make($request->json()->all(), [
                'name' => 'required',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->toJson(), 400);
            }

            // Utilizamos una transacción para asegurar que se cree tanto el usuario como la identidad
            DB::beginTransaction();

            $uuid = Str::uuid()->toString();

            $user = User::create(array_merge(
                $validator->validate(),
                [
                    'password' => bcrypt($request->json('password')),
                    'uuid' => $uuid,
                ]
            ));

            $currentTimestamp = time();

            $identity = new Identity([
                'iss' => 'http://test.gosice.com',
                'sub' => 'Authentication',
                'aud' => 'http://186.70.111.82',
                'typ' => 'json',
                'uuid' => $uuid,
                'name' => 'PRUEBA',
                'surname' => 'DESARROLLO',
                'email' => $request->json('email'),
                'avatar' => 'http://test.gosice.com/resources/images/avatar.png',
                'iat' => $currentTimestamp,
                'exp' => $currentTimestamp + 3600,
            ]);

            $identity->save();

            // Confirmamos la transacción si no hay excepciones
            DB::commit();

            return response()->json([
                'message' => 'Usuario creado exitosamente',
                'user' => $user,
                'identity' => $identity,
            ], 201);
        } catch (\Exception $e) {
            // En caso de excepción, revertimos la transacción y manejamos el error
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ], $e->getCode());
        }
    }



}
