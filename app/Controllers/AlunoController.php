<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmprestimosModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AlunosModel;

class AlunoController extends BaseController
{
    public function index()
    {
        //
    }


    public function cadastrar_aluno(){
        $AlunoModel = new AlunosModel();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT
        ]);
        echo view('Aluno/CadastroAlunoView', [
            'environment' => ENVIRONMENT
        ]);
        echo view("usuario/template/FooterView");
    }


    public function cadastrar_aluno_post()
    {

        $livroModel = new AlunosModel();

        $data = [
            'nome'             => $this->request->getVar('nome'),
            'email'            => $this->request->getVar('email'),
            'telefone'         => $this->request->getVar('telefone'),
            'data_nascimento'  => $this->request->getVar('data_nascimento'),
            'data_cadastro'    => date('Y-m-d H:i:s'),
        ];


        if ($livroModel->insert($data)) {
            return redirect()->to('/home')->with('success', 'Aluno cadastrado com sucesso!');
        } else {
            return redirect()->to('/home')->with('error', 'Erro ao cadastrar o aluno.');
        }

    }


    public function GerenciaAluno(){

        $alunoModel = new AlunosModel();
        $dados = $alunoModel->dados();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT
        ]);
        echo view('Aluno/GerenciaAlunoView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);
        echo view("usuario/template/FooterView");
    }

    public function apaga_aluno($id_aluno)
    {

        $alunoModel = new AlunosModel();
        $emprestimosModel = new EmprestimosModel();

        $id_aluno = base64_decode($id_aluno) / 54655345764678;        

        $pode_apagar=$emprestimosModel->verifica_delete($id_aluno);
        
        if (!$pode_apagar){
            $aluno = $alunoModel->where('id_aluno', $id_aluno)->first();
            if ($aluno) {
                $data = ['status' => 'inativo'];
        
                $alunoModel->set($data)->where('id_aluno', $id_aluno)->update();
        
                return redirect()->to('/GerenciaAluno')->with('success', 'Aluno desativado com sucesso!');
            } else {
                return redirect()->to('/GerenciaAluno')->with('error', 'Aluno não encontrado!');
            }
        }
        else {
            return redirect()->to('/GerenciaAluno')->with('error', 'O Aluno possui pendência(s)<br>e não pode ser apagado!');
        }
    
    

    }
    
    


}
