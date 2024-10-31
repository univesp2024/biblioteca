<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\RandomUserHelper;
use App\Models\LocaisModel;
use App\Models\UsuarioModel;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;

class UsuarioController extends BaseController
{
    public function index()
    {
        $nome = RandomUserHelper::geraNome();
        $tipoSanguineo = RandomUserHelper::geraTipoSanguineo();
        $fatorRh = RandomUserHelper::geraFatorRh();
        $email = strtolower(str_replace(' ', '.', $nome))."@gatomail.com";
        $sexo = preg_match('/[aezs]$/i', explode(' ', $nome)[0]) ? 'F' : 'M';
        $endereco = RandomUserHelper::geraEndereco();
        $telefone = RandomUserHelper::geraTelefone();
        $dataNascimento = RandomUserHelper::geraDataNascimento();

        return view('login/CadastroView',[
            'environment' => ENVIRONMENT,
            'nome' => $nome,
            'tipoSanguineo' => $tipoSanguineo,
            'fatorRh' => $fatorRh,
            'email' => $email,
            'sexo' => $sexo,
            'endereco' => $endereco,
            'telefone' => $telefone,
            'dataNascimento' => $dataNascimento
        ]);
    }

    // Cadastro de usuário
    public function salvar_usuario()
    {

        $session = session();
        $model = new UsuarioModel();

        $cpf = $this->request->getPost('cpf');

        $cpf = str_replace(array('.', '-'), '', $cpf);
        $cpf = intval($cpf);

        $userExists = $model->where('cpf', $cpf)->first();
        
        if ($userExists) {
            // Usuário já existe, faça algo (exemplo: exiba uma mensagem de erro)
            $session->setFlashdata('msg', 'O CPF informado já está cadastrado!');
            return redirect()->to('/');
            //return redirect()->to(site_url('/sucesso'))->with('mensagem', 'O CPF já está cadastrado!');
        } else {
            // Usuário não existe, proceda com a inserção
            $data = [
                //'cpf' => $this->request->getPost('cpf'),
                'cpf' => $cpf,
                'nome_completo' => $this->request->getPost('nome_completo'),
                'data_nascimento' => $this->request->getPost('data_nascimento'),
                'endereco' => $this->request->getPost('endereco'),
                'municipio' => $this->request->getPost('municipio'),
                'telefone' => $this->request->getPost('telefone'),
                'email' => $this->request->getPost('email'),
                'sexo' => $this->request->getPost('sexo'),
                'senha' => password_hash($this->request->getPost('senha'), PASSWORD_DEFAULT),
                #'senha' => $this->request->getPost('senha'),
            ];
        
            $model->insert($data);


            return redirect()->to(site_url('/sucesso'))->with('mensagem', 'Usuário castrado com sucesso!');

        }

     
        //return redirect()->to(site_url('/sucesso'));
    }

    public function update_usuario() {
        $session = session();
        $model = new UsuarioModel();
        
        $id_usuario = session()->get('id_usuario');

        $cpfLimpo = str_replace(['.', '-'], '', $this->request->getPost('cpf'));

        $data = [
            //'cpf' => $cpfLimpo,
            'nome_completo' => $this->request->getPost('nome_completo'),
            'data_nascimento' => $this->request->getPost('data_nascimento'),
            'endereco' => $this->request->getPost('endereco'),
            'municipio' => $this->request->getPost('municipio'),
            'telefone' => $this->request->getPost('telefone'),
            'email' => $this->request->getPost('email'),
            'sexo' => $this->request->getPost('sexo'),
        ];

        //var_dump($data);
        //die;


        

        //$model->insert($data);
        $model->update($id_usuario, $data);


        $ses_data = [
            'nome_completo' => $this->request->getPost('nome_completo'),
            'e-mail'        => $this->request->getPost('email'),
        ];
        $session->set($ses_data);

        return redirect()->to(base_url('meuperfil'))->with('mensagem', 'Atualização realizada com sucesso!');
        //return redirect()->to(site_url('/sucesso'));
    }

    public function sucesso()
    {
        session()->destroy();
        return view('manutencao/SucessoView');
    }    


    public function adminMeuPerfil()
    {

        $model = new UsuarioModel();
        //$modelLocais = new LocaisModel();
        $id_usuario = session()->get('id_usuario');
        #var_dump($id_usuario);
        #die();
        $dadosUsuario = $model->getByUserId($id_usuario);
        //return view('usuario/MeuPerfilView', ['dadosUsuario' => $dadosUsuario]);
        
        echo view("admin/template/HeaderView");
        echo view("admin/template/SidebarView", ['environment' => ENVIRONMENT,  'hasData' => '$modelLocais->hasData()']);
        echo view('admin/MeuPerfilView', ['dadosUsuario' => $dadosUsuario]);
        echo view("admin/template/FooterView");

    }        

    public function meuperfil()
    {

        $model = new UsuarioModel();
        //$modelLocais = new LocaisModel();
        
        $id_usuario = session()->get('id_usuario');
        
        #var_dump($id_usuario);
        #die();

        $dadosUsuario = $model->getByUserId($id_usuario);
        
        //return view('usuario/MeuPerfilView', ['dadosUsuario' => $dadosUsuario]);
        
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", ['environment' => ENVIRONMENT,  'hasData' => '$modelLocais->hasData()']);
        
        echo view('usuario/MeuPerfilView', ['dadosUsuario' => $dadosUsuario]);
        echo view("usuario/template/FooterView");

        #var_dump("Meu perfil");
    }    

    public function update_senha() {
        $senhaAntiga = $this->request->getVar("velhaSenha");
        $senhaNova = $this->request->getVar("novaSenha");

        $model = new UsuarioModel();
        $id_usuario = session()->get('id_usuario');
        $dadosUsuario = $model->getByUserId($id_usuario);

        if($senhaAntiga != '' && password_verify($senhaAntiga, $dadosUsuario['senha'])){
            $dadosUsuario['senha'] = password_hash($senhaNova, PASSWORD_DEFAULT);
            $model->update($id_usuario, $dadosUsuario);
            return redirect()->to(site_url('/home'))->with('mensagem', 'Atualização realizada com sucesso!');
        }

        return redirect()->to(site_url('/alterarsenha'))->with('mensagem', 'Senha errada!');
    }

    public function alterarsenha() {
        //$modelLocais = new LocaisModel();
        $modelUser = new UsuarioModel();
        $idUser = session()->get('id_usuario');
        $dadosUsuario = $modelUser->getByUserId($idUser);

        if (session('status')==99) {
            echo view("admin/template/HeaderView");
            echo view("admin/template/SidebarView", ['environment' => ENVIRONMENT,  'hasData' => '$modelLocais->hasData()']);
            echo view('admin/AlterarSenhaView', ['dadosUsuario' => $dadosUsuario]);
            echo view("admin/template/FooterView");
        }
        else {
            echo view("usuario/template/HeaderView");
            echo view("usuario/template/SidebarView", ['environment' => ENVIRONMENT,  'hasData' => '$modelLocais->hasData()']);
            echo view('usuario/AlterarSenhaView', ['dadosUsuario' => $dadosUsuario]);
            echo view("usuario/template/FooterView");
        }
    }

}
