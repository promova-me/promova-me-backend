<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /* Função de inserção de usuários ao banco */
    public function add(Request $req)
    {
        try {

            $data = $req->all();

            /* Se não tiver uma senha, uma randomica é criada automaticamente e depois é criptografada */
            if ($req->filled('password') == false) {
                $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
                $password = substr($random, 0, 10);
                $data['password'] = Hash::make($password);
            }

            if(!$data['password'] == NULL){
                $user = $this->user->create($data);
            } else {
                return response()->json([API\ApiError::errorMessage('Campo de senha vazio.'), 1010], 400);
            }

            if ($user) {
                try {
                    if ($req->has('id_interested_course')) {
                        $user->visitant()->create($data);
                        $user->condition_terms()->create($data);
                        $return = ['data' => ['message' => 'Visitante cadastrado com sucesso!']];
                        return response()->json($return, 201);
                    }

                    if ($req->has('id_course', 'ra')) {
                        $user->student()->create($data);
                        $user->condition_terms()->create($data);
                        $return = ['data' => ['message' => 'Estudante cadastrado com sucesso!']];
                        return response()->json($return, 201);
                    }
                } catch (\Exception $e) {
                    if (config('app.debug')) {
                        return response()->json([API\ApiError::errorMessage($e->getMessage(), 1010)], 400);
                    }

                    return response()->json(API\ApiError::errorMessage('Houve um erro ao cadastrar usuário'), 400);
                }
            }

        } catch (\Exception $e) {
            if (config('app.debug')) {

                return response()->json([API\ApiError::errorMessage($e->getMessage(), 1010)], 400);
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro ao realizar a operação'), 400);
        }
    }

    public function update(Request $req, $id)
    {
        try {

            $data = $req->all();
            $user = $this->user->find($id);
            $user->update($data);

            $condition = $req->only('as_viewed', 'is_confirmed', 'viewed_data');

            if ($user) {
                if ($req->has('id_interested_course')) {
                    $visitant = $req->only('id_interested_course');
                    $user->visitant()->update($visitant);

                    $user->condition_terms()->update($condition);

                    $return = ['data' => ['message' => 'Visitante atualizado com sucesso!']];
                    return response()->json($return, 201);
                }

                if ($req->has('id_course', 'ra')) {
                    $student = $req->only('id_course', 'ra');
                    $user->student()->update($student);

                    $user->condition_terms()->update($condition);

                    $return = ['data' => ['message' => 'Estudante atualizado com sucesso!']];
                    return response()->json($return, 201);
                }
            }

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json([API\ApiError::errorMessage($e->getMessage(), 1010)], 400);
            }

            return response()->json(API\ApiError::errorMessage('Houve um erro ao realizar a operação'), 400);
        }
    }

    /* Função que exibe todos os registros, retornando um JSON
    com informações para a paginação. */
    //testando
    public function index()
    {
        return response()->json($this->user->paginate(10));
    }

    /* Função que exibe um registro específico */
    public function show(User $id)
    {
        $data = ['data' => $id];
        return response()->json($data);
    }
}
