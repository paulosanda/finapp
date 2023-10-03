<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Documentation\Schemas\UserSchemas;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/user/register",
     *     tags={"User"},
     *     summary="Cria um novo usuário",
     *     description="Cria um novo usuário com base nos dados fornecidos. Quando criado o user não está enable, será preciso o admin libera-lo",
     *     operationId="createUser",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso - Retorna os dados do novo usuário criado",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", format="int64", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação - Retorna os erros de validação",
     *         @OA\JsonContent(type="object", @OA\Property(property="errors", type="object"))
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor - Retorna uma mensagem de erro",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string"), @OA\Property(property="message", type="string"))
     *     ),
     * )
     */



    public function store(Request $request)
    {
        $newUserData = Validator::make($request->all(),[
           'name' => 'string|required|max:100',
            'email' => 'string|email|required',
            'password' => 'string|required|min:6'
        ]);

        if ($newUserData->fails()) {
            return response()->json(['errors' => $newUserData->errors()], 422);
        }
        try {
            $newUserCreate = User::create($newUserData->validate());

            return response()->json($newUserCreate, 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao criar o usuario', 'message' => $e->getMessage()], 500);

        }

    }
}
