<?php

namespace App\Controllers;
use App\Models\LivroModel;

class LivroController extends BaseController
{

    public function index()
    {

        $livroModel = new LivroModel();
        $data['livros'] = $livroModel->findAll();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT, 
            'hasData' => $data
        ]);
        
        echo view('Livro/EmprestarView', [
            'environment' => ENVIRONMENT
        ]);

        
        echo view("usuario/template/FooterView");
        


    }


}
