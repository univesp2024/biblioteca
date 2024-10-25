<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\emailHelper;
use App\Helpers\RandomUserHelper;
use App\Models\DoacaoModel;
use App\Models\SolicitacaoModel;
use App\Models\LocaisModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class SolicitacaoController extends BaseController
{
    // Chama a View para listar todas as solicitações de doação
    public function index()
    {

        
        // Vertifica se o usuário é administrado código 99
        if (session()->get('status') == 99)
        {
            return redirect()->to('dashboard');
        }

        
        $model = new SolicitacaoModel();
        $modelDoacao = new DoacaoModel();

        $id_usuario = session()->get('id_usuario');
        
        $minhasSolicitacoes = $model->getByUserId($id_usuario);
 
        //var_dump($minhasSolicitacoes);
        //echo "<br>";
        //echo "<br>";
        //$contaStatus = $modelDoacao->contaStatus($id_usuario);
        //var_dump($contaStatus);
        //die();


        $nomeAleatorio = RandomUserHelper::geraNome();
        #var_dump($minhasSolicitacoes);
        #die();
        
        
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'hasData' => true
        ]);
        
        echo view("usuario/solicitacao/ListaSolicitacaoView", [
            'environment' => ENVIRONMENT,
            'id_usuario' => $id_usuario,
            'solicitacoes' => $minhasSolicitacoes,
            'nomeAleatorio' => (ENVIRONMENT=='development')? $nomeAleatorio: '',
        ]);

        echo view("usuario/template/FooterView");


    }


    function solicitadoacao() {

        $modelSolicitacao = new SolicitacaoModel();
        $modelLocalDoacao = new LocaisModel();

        $id_usuario = session()->get('id_usuario');
        $minhasSolicitacoes = $modelSolicitacao->getByUserId($id_usuario);
        $nomeAleatorio = RandomUserHelper::geraNome();
        
        $locais['locaisDoacao'] = $modelLocalDoacao
                ->where('id_local !=', 1)
                ->findAll();
        
        
        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'hasData' => true
        ]);
        
        echo view("usuario/solicitacao/SolicitacaoDoacaoView", [
            'environment' => ENVIRONMENT,
            'id_usuario' => $id_usuario,
            'solicitacoes' => $minhasSolicitacoes,
            'nomeAleatorio' => 
                 (ENVIRONMENT=='development')? $nomeAleatorio: '',
            'locais' => $locais['locaisDoacao']
        ]);

        echo view("usuario/template/FooterView");

    }


    // Método POST para inser as solicitações de doação
    function inseresolicitadoacao() {
       
        $session = session();
        $modelSolicitacao = new SolicitacaoModel();
        $modelUsuario = new UsuarioModel();
        $modelDoacao = new DoacaoModel();

        $cpfReceptor = $this->request->getPost('cpfReceptor');
        $cpfReceptor = str_replace(array('.', '-'), '', $cpfReceptor);
        $cpfReceptor = intval($cpfReceptor);

        $nomeReceptor = $this->request->getPost('nomeReceptor');
        $tipoSangue = $this->request->getPost('tipoSangue');
        $fatorRh = $this->request->getPost('fatorRh');
        $localDoacao = $this->request->getPost('localDoacao');


        /*
            $qtdeDoadoresSelecionar = 2;
            $resultado = $modelUsuario -> selecionaDoadores(
                $tipoSangue, 
                $fatorRh, 
                $qtdeDoadoresSelecionar
            );

            var_dump($resultado);
            echo "<br>";
            echo count($resultado);

            die();
        */

        
        //$data = $model->where('cpf', $logincpf)->first();
        //var_dump($cpfReceptor);
        // Verificar se o CPF do receptor já existe
        // $resultado = $model->getCPFreceptor($cpfReceptor);
        // var_dump($resultado);
        // die();

        $cpfExists = $modelSolicitacao->where('cpf_receptor', $cpfReceptor)->first();
        
        //if ($cpfExists) {
        if (false) {
            $session->setFlashdata(
                'msgSolicitaDoacao', 
                'Existe outra solicitação para essa pessoa!<br>Aguarde 5 dia para solicitar novamente!'
            );

            
        }
        else {

            $id_usuario = session()->get('id_usuario');
            $nomeReceptor = $this->request->getPost('nomeReceptor');
            $tipoSangue = $this->request->getPost('tipoSangue');
            $fatorRh = $this->request->getPost('fatorRh');
            $localDoacao = $this->request->getPost('localDoacao');

            $data = [
                'id_usuario' => $id_usuario,
                'tipo_sanguineo' => $tipoSangue,
                'fator_rh' => $fatorRh,
                'data_solicitacao' => date('Y-m-d H:i:s'),
                'cpf_receptor' => $cpfReceptor,
                'nome_receptor' => $nomeReceptor,
                'id_local_doacao' => $localDoacao,
                'status' => '1'
            ];

            
        
            $modelSolicitacao->insert($data);    
            $ultimoIDInserido = $modelSolicitacao->insertID();   
            
            // ********************************************************
            //
            // Criar rotina para enviar a solicitação para os doadores
            //
            // ********************************************************

            $qtdeDoadoresSelecionar = 4;

            $resultado = $modelUsuario -> selecionaDoadores(
                $tipoSangue, 
                $fatorRh, 
                $qtdeDoadoresSelecionar
            );




            if (empty($resultado)) {
                $session->setFlashdata(
                    'msgSolicitaDoacaoErro', 
                    'Não há doadores suficientes!'
                );
                return redirect()->to('listasolicitacao');
            }



            //$nome = RandomUserHelper::geraNome();
            //emailHelper::enviar('fcart@hotmail.com', 'Testando o envio de e-mail', 'Olá este é um teste de envio de e-mail');
            
            foreach ($resultado as $key => $linha) {

                //var_dump($linha);

                $data = [
                    'id_usuario' => $linha["id_usuario"],
                    'id_local' => $localDoacao,
                    'id_solicitacao' => $ultimoIDInserido,
                    'data_solicitacao' => date('Y-m-d H:i:s'),
                    'status' => 1
                ];

               
           
                // Linha original do sistema *******************************************
                $modelDoacao->insert($data);


                // ***************************************************************
                //               Rotina para enviar e-mail ao doador
                // ***************************************************************

                


                
                //echo 'Id Usuário:'.$linha["id_usuario"];
                //echo 'CPF:'.$linha["cpf"];
                //echo 'Nome:'.$linha["nome_completo"];
                //echo 'Nascimento:'.$linha["data_nascimento"];
                //echo 'Doador:'.$linha["e_doador"];
                //echo 'Sangue:'.$linha["tipo_sanguineo"].$linha["fator_rh"];
                //echo 'Sexo:'.$linha["sexo"];
                //echo 'ultima doacao:'.$linha["data_ultima_doacao"];
                //echo 'Status:'.$linha["status"];
                //echo 'Sangue concatenado:'.$linha["sangue"];                
                
            }

             //var_dump($resultado);
             //echo "<br>Quatidade de registros:";
             //echo 'Qtde registros '.count($resultado);
            
            $session->setFlashdata(
                'msgSolicitaDoacao', 
                'Solicitação de doação cadastrada com sucesso!'
            );
        }


        
        return redirect()->to('listasolicitacao');
        
        



        // $model = new SolicitacaoModel();

        
    }
}
