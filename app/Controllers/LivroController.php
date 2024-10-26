<?php

namespace App\Controllers;
use App\Models\LivroModel;

class LivroController extends BaseController
{

    public function emprestar_livro()
    {

        $livroModel = new LivroModel();
        $dados = $livroModel->dados();
        

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT
        ]);
        echo view('Livro/EmprestarView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);
        echo view("usuario/template/FooterView");
    }    



    public function devolver_livro()
    {
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT
        ]);
        echo view('Livro/DevolverView', [
            'environment' => ENVIRONMENT
        ]);
        echo view("usuario/template/FooterView");
    }    
    
    public function consultar_livro()
    {

        $livroModel = new LivroModel();
        $dados = $livroModel->dados();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT
        ]);
        echo view('Livro/ConsultarView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);
        echo view("usuario/template/FooterView");
    }      
    
    
    public function finaliza_emprestimo($id_livro)
    {

        $livroModel = new LivroModel();
        $dados_livro = $livroModel->dados_by_id($id_livro);

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT
        ]);
        echo view('Livro/FinalizaEmprestimoView', [
            'environment' => ENVIRONMENT,
            'id_livro' => $id_livro,
            'dados' => $dados_livro
        ]);
        echo view("usuario/template/FooterView");
    }      



}
