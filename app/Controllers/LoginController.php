<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\MinhasFuncoesHelper;

class LoginController extends BaseController
{
    public function index()
    {
        
        $MinhasFuncoesHelper = new MinhasFuncoesHelper();
        
        return view('login/LoginView', [
            'environment' => ENVIRONMENT,
            'MinhasFuncoesHelper' => $MinhasFuncoesHelper
        ]);
    }
    

    
    public function restrito(){
        var_dump("Admin only");
    }


    public function autenticar()
    {
        $session = session();
        $model = new UsuarioModel();
        
        $logincpf = $this->request->getVar('cpf');
        $loginsenha = $this->request->getVar('senha');

        $logincpf = str_replace(array('.', '-'), '', $logincpf);
        $logincpf = intval($logincpf);
       
        $data = $model->where('cpf', $logincpf)->first();
        
        if($data){
            $verify_pass = password_verify($loginsenha, $data['senha']);
            if($verify_pass){
                $ses_data = [
                    'id_usuario'    => $data['id_usuario'],
                    'cpf'           => $data['cpf'],
                    'nome_completo' => $data['nome_completo'],
                    'e-mail'        => $data['email'],
                    'status'        => $data['status'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);

                #var_dump($ses_data);
                #die();
                
                # 0 - Não validado   # 1 - Usuário,  # 99 - Admin                
                if ($data['status'] == 99) { 
                    return redirect()->to('/dashboard');
                } 
                else if ($data['status'] == 1) {
                    return redirect()->to('/home');
                }
                else if ($data['status'] == 0) {
                    $session->setFlashdata('msg', 'Usuário não validado');
                    return redirect()->to('/');
                }
            }else{
                $session->setFlashdata('msg', 'Senha errada');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'CPF não encontrado');
            return redirect()->to('/');
        }     

    }    

    public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}


}
