<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\RandomUserHelper;
use App\Models\LivroModel;
use App\Models\EmprestimosModel;
class HomeController extends BaseController
{
    public function index()
    {


        if (session()->get('status') == 99)
        {
            return redirect()->to('dashboard');
        }

        $id_usuario = session()->get('id_usuario');
        $emailcookie = $this->request->getCookie('emailteste');

        $livroModel = new LivroModel();
        $emprestimoModel = new EmprestimosModel();

        $data['total_livros'] = $livroModel->contarLivros();
        $data['livros_emprestados'] = $emprestimoModel->contarEmprestados();
        $data['livros_disponiveis'] = $data['total_livros'];  //-$data['livros_emprestados'];
        
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT, 
            'hasData' => '',
            'rotaAtual' => uri_string()
        ]);
        
        echo view("usuario/MainView", [

            'emailcookie' => $emailcookie,
            'total_livros' => $data['livros_disponiveis'],
            'livros_emprestados' => $data['livros_emprestados']

        ]);
        echo view("usuario/template/FooterView");
    }
}
