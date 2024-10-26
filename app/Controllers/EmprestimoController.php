<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmprestimosModel;
use CodeIgniter\HTTP\ResponseInterface;


class EmprestimoController extends BaseController
{
    public function index()
    {
        //
    }

    public function historico_emprestimos()
    {
        
        $dadosModel = new EmprestimosModel();
        $dados = $dadosModel->dados_historico_emprestimos();
        

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT
        ]);
        echo view('Emprestimos/HistoricoView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados,
        ]);
        echo view("usuario/template/FooterView");        

    }



}
