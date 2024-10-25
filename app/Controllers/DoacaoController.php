<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\RandomUserHelper;
use App\Models\DoacaoModel;
use App\Models\LocaisModel;
use App\Models\SolicitacaoModel;
use CodeIgniter\HTTP\ResponseInterface;

class DoacaoController extends BaseController
{
    public function index()
    {
        die("Você não tem autorização");
    }

    public function minhasdoacoes()
    {
        if (session()->get('status') == 99)
        {
            return redirect()->to('dashboard');
        }

        $modelDoacao = new DoacaoModel();
        $modelLocais = new LocaisModel();
        $id_usuario = session()->get('id_usuario');
        $doacoes = $modelDoacao->getByUserId($id_usuario);
        
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT, 
            'hasData' => $modelLocais->hasData()
        ]);
        
        echo view("usuario/doacao/MinhasDoacoesView", [
            'doacoes' => $doacoes,
        ]);
        
        echo view("usuario/template/FooterView");

    }    

    public function inserirdoacao()
    {
        $model = new SolicitacaoModel();
        $id_usuario = session()->get('id_usuario');
        $minhasSolicitacoes = $model->getByUserId($id_usuario);
        $nomeAleatorio = RandomUserHelper::geraNome();

        
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'hasData' => true
        ]);
        
        echo view("usuario/doacao/InserirDoacaoView", [
            'environment' => ENVIRONMENT,
            'id_usuario' => $id_usuario,
            'solicitacoes' => $minhasSolicitacoes,
            'nomeAleatorio' => (ENVIRONMENT=='development')? $nomeAleatorio: '',
        ]);

        echo view("usuario/template/FooterView");
    }

    public function inserirdoacaopost() {
        $session = session();
        $id_usuario = $session->get('id_usuario');
        $modelDoacao = new DoacaoModel;
        $modelSolicitacao = new SolicitacaoModel();

/*
        $dadosRecebidos = $this->request->getPost();
        var_dump($dadosRecebidos);
        die();

array(5) { 
    ["cpfReceptor"]=> string(14) "111.111.111-11" 
    ["nomeReceptor"]=> string(15) "Carlinho Borges" 
    ["tipoSangue"]=> string(1) "A" 
    ["fatorRh"]=> string(1) "+"
     ["dataDoacao"]=> string(10) "2024-03-29" 
    }
*/

        $dadosSolicitação = [
            'id_usuario' => $id_usuario,
            'tipo_sanguineo' => $this->request->getPost('tipoSangue'),
            'fator_rh' => $this->request->getPost('fatorRh'),
            'data_solicitacao' => date('Y-m-d H:i:s'),
            'cpf_receptor' => $this->request->getPost('cpfReceptor'),
            'nome_receptor' => $this->request->getPost('nomeReceptor'),
            'id_local_doacao' => 1,
            'status' => 77
        ];
        
        $modelSolicitacao -> insert($dadosSolicitação);
        
        $ultimoIdSolicitacaoInserido = $modelSolicitacao->insertID();

        
        $dados = [
            'id_usuario' => $id_usuario,
            'id_local' => 1,
            'id_solicitacao'=> $ultimoIdSolicitacaoInserido,
            'data_solicitacao' => date('Y-m-d H:i:s'),
            'data_doacao' => $this->request->getPost('dataDoacao'),
            'status' => 2
        ];

        $modelDoacao->insert($dados);


        return redirect()->to(site_url('minhasdoacoes'));
        



    }
    
}
