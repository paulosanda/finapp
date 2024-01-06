<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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



    public function store(Request $request): \Illuminate\Http\JsonResponse
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

    /**
     * @OA\Get(
     *     path="/api/user/blocked",
     *     tags={"Admin"},
     *     summary="desbloqueia usuários",
     *     description="Endpoint para consulta de usuarios bloqueados (enable=false), apenas autenticados com token ability admin pode acessar",
     *     operationId="unclokUser",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Sucesso",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="id", type="integer",format="int64"),
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="email", type="string", format="email"),
     *                  @OA\Property(property="enable", type="boolean")
     *              ),
     *          ),
     *      ),
     *  )
     *
     * */
    public function blocked(): \Illuminate\Http\JsonResponse
    {
        $users = User::where('enable', false)->get();

        return response()->json($users, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/user/unlock/{id}",
     *     tags={"Admin"},
     *     summary="Desbloqueia um usuário",
     *     description="Endpoint para desbloquear um usuário com base em seu ID",
     *     operationId="unlockUser",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do usuário a ser desbloqueado",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário desbloqueado com sucesso",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor",
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function unlock($id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $user->update(['enable' => true]);

        return response()->json(['message' => 'Usuário desbloqueado com sucesso'], 200);

    }



}
