<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\RandomUserHelper;
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
        
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT, 
            'hasData' => ''
        ]);
        
        echo view("usuario/MainView", [
            'doacoes' => '$doacoes',
            'qtdeDoacaoRealizada' => '$qtdeDoacaoRealizada',
            'qtdeSolicitacaoRealizada' => '$qtdeSolicitacaoRealizada',
            'qtdeTotalDoado' => '$qtdeTotalDoado',
            'dataultimaDoacao' => '$dataultimaDoacao',
            'dataultimasolicitacao' => '$dataultimasolicitacao',
            'emailcookie' => $emailcookie

        ]);
        echo view("usuario/template/FooterView");
    }
}
