<?php

namespace App\Controllers;

class LivroController extends BaseController
{
    public function indexa(): string
    {
        return view('Livro/EmprestarView', [
            'environment' => ENVIRONMENT
        ]);
    }


    public function index()
    {

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT, 
            'hasData' => ''
        ]);
        
        echo view('Livro/EmprestarView', [
            'environment' => ENVIRONMENT
        ]);

        
        echo view("usuario/template/FooterView");
        


    }


}
