<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     tags={"Authentication"},
     *     summary="Autenticar um usuário",
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="usuario@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="senha123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", example="token_de_acesso"),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *             @OA\Property(property="expires_in", type="integer", example=3600)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciais inválidas",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Credenciais inválidas.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Conta não habilitada",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Sua conta não está habilitada para acessar esta área.")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->enable) {
                $tokenAbilities = $user->is_admin ? ['admin'] : [];

                return $token = $user->createToken('user-token', $tokenAbilities)->plainTextToken;

            } else {
                return response()->json(['error' => 'Sua conta não está habilitada para acessar esta área.'], 403);
            }
        }

        return response()->json(['error' => 'Credenciais inválidas.'], 401);
    }
}
