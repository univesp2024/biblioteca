<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DoacaoModel;
use App\Models\LocaisModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
 
    public function __construct(){

    }

    public function index()
    {
        # Verifica se o usário é administrador
        if (session()->get('status') != 99)
        {
            session()->destroy();
            return redirect()->to('/');
        }

        // return view('admin/DashboardView');
        $model = new DoacaoModel();
        $modelLocais = new LocaisModel();
        $id_usuario = session()->get('id_usuario');
        #var_dump($id_usuario);
        #die();
        $doacoes = $model->getByUserId($id_usuario);
        
        echo view("admin/template/HeaderView");
        echo view("admin/template/SidebarView", 
                 ['environment' => ENVIRONMENT, 
                  'hasData' => $modelLocais->hasData()
                 ]
        );
        echo view("admin/DashboardView", ['doacoes' => $doacoes]);
        echo view("admin/template/FooterView");

    }
}
