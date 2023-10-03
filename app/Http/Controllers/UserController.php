<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use function Laravel\Prompts\error;

class UserController extends Controller
{
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
