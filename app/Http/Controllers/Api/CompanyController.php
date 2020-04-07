<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /* Função de inserção de usuários ao banco */
    public function add(Request $req)
    {
       try {

           $data=$req->all();
            if($data['newsletter']=='true'){
                $data['newsletter']=1;
            }else{
                $data['newsletter']=0;
            }

            $company = $this->company->create($data);

            return response()->json(['status'=>'success','msg'=>'Empresa cadastrada com sucesso!']);
        } catch (\Exception $e) {
           dd($e);
        }
    }

    public function update(Request $req, $id)
    {
        try {

            $data = $req->all();

//            dd($data);
            $company=$this->company->find($data['id']);
            $company->update($data);
            return response()->json(['status'=>'success','msg'=>'Empresa cadastrada com sucesso!']);

        } catch (\Exception $e) {
            dd($e);
        }
    }

    /* Função que exibe todos os registros, retornando um JSON
    com informações para a paginação. */
    public function index()
    {
        echo 'GET mermo';
//        return response()->json($this->user->paginate(10));
    }

    /* Função que exibe um registro específico */
    public function show(User $id)
    {
        $data = ['data' => $id];
        return response()->json($data);
    }
}
