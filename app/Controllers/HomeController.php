<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DoacaoModel;
use App\Models\LocaisModel;
use App\Models\SolicitacaoModel;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\RandomUserHelper;
class HomeController extends BaseController
{
    public function index()
    {

        /*
        $cookie = $this->request->getCookie('emailteste');
        if ($cookie !== null) {
            echo "Valor do cookie: " . $cookie;
            $cookie_name = 'emailteste';
            $cookie_value = '';
            $expire_time = time() - 3600;
            setcookie($cookie_name, $cookie_value, $expire_time, '/');
            echo "Cookie '$cookie_name' limpo com sucesso!";
            die();
        }
        */

        if (session()->get('status') == 99)
        {
            return redirect()->to('dashboard');
        }

        $modelDoacao = new DoacaoModel();
        $modelSolicitacao = new SolicitacaoModel();

        $modelLocais = new LocaisModel();
        $id_usuario = session()->get('id_usuario');
        $doacoes = $modelDoacao->getByUserId($id_usuario);
        
        $qtdeDoacaoRealizada = 
             $modelDoacao->qtdeDoacaoRealizada($id_usuario);

        $qtdeSolicitacaoRealizada =
             $modelSolicitacao->qtdeSolicitacaoRealizada($id_usuario);

        $qtdeTotalDoado =
             $modelDoacao->qtdeTotalDoado();

        $dataultimaDoacao= 
             $modelDoacao->ultimaDoacao($id_usuario);

        $dataultimasolicitacao =
             $modelSolicitacao->ultimaSolicitacao($id_usuario);


        $emailcookie = $this->request->getCookie('emailteste');
            
        
        
        echo view("usuario/template/HeaderView");

        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT, 
            'hasData' => $modelLocais->hasData()
        ]);
        
        echo view("usuario/MainView", [
            'doacoes' => $doacoes,
            'qtdeDoacaoRealizada' => $qtdeDoacaoRealizada,
            'qtdeSolicitacaoRealizada' => $qtdeSolicitacaoRealizada,
            'qtdeTotalDoado' => $qtdeTotalDoado,
            'dataultimaDoacao' => $dataultimaDoacao,
            'dataultimasolicitacao' => $dataultimasolicitacao,
            'emailcookie' => $emailcookie

        ]);
        
        echo view("usuario/template/FooterView");

       
    }

    public function limpatabela(){
               # Criando os objetos e limpando as tabelas
               $modelDoacao = new DoacaoModel();
               $modelDoacao->db->query('SET FOREIGN_KEY_CHECKS = 0;');
               $modelDoacao->truncate();
               $modelDoacao->db->query("ALTER TABLE doacao AUTO_INCREMENT = 1;");
               $modelDoacao->db->query('SET FOREIGN_KEY_CHECKS = 1;');
               
       
               $modelLocais = new LocaisModel();    
               $modelLocais->db->query('SET FOREIGN_KEY_CHECKS = 0;');
               $modelLocais->truncate();
               $modelLocais->db->query("ALTER TABLE locais_doacao AUTO_INCREMENT = 1;");        
               $modelLocais->db->query('SET FOREIGN_KEY_CHECKS = 1;');        
               
               
               $modelUsuario = new UsuarioModel();        
               $modelUsuario->db->query('SET FOREIGN_KEY_CHECKS = 0;');
               $modelUsuario->truncate();
               $modelUsuario->db->query("ALTER TABLE usuarios AUTO_INCREMENT = 1;");                
               $modelUsuario->db->query('SET FOREIGN_KEY_CHECKS = 1;');


               $modelSolicitacao = new SolicitacaoModel();        
               $modelSolicitacao->db->query('SET FOREIGN_KEY_CHECKS = 0;');
               $modelSolicitacao->truncate();
               $modelSolicitacao->db->query("ALTER TABLE solicitacao  AUTO_INCREMENT = 1;");                
               $modelSolicitacao->db->query('SET FOREIGN_KEY_CHECKS = 1;');               

               return redirect()->to('/');
    }


    public function ficticios() {

        helper('RandomNameHelper');

        
        $qtdeUsuarios = 50;  // Qtde usuários
        $qtdeDoacao = 0;  // Qtde doações

        //var_dump(RandomUserHelper::geraDatasAletorias(80));
        //die();

        # Criando os objetos e limpando as tabelas
        $modelDoacao = new DoacaoModel();
        $modelLocais = new LocaisModel();    
        $modelUsuario = new UsuarioModel();   
        $modelSolicitacao = new SolicitacaoModel();
        
       
        # Desabilitando os relacionamentos das tabelas
        $modelDoacao->db->query('SET FOREIGN_KEY_CHECKS = 0;');
        $modelLocais->db->query('SET FOREIGN_KEY_CHECKS = 0;');
        $modelUsuario->db->query('SET FOREIGN_KEY_CHECKS = 0;');
        $modelSolicitacao->db->query('SET FOREIGN_KEY_CHECKS = 0;');

        //****************************************************** */
        # inserindo usuários
        //****************************************************** */
        $dadosUsuario = [];
        
        # Pega o maior número do CPF
        $maiorCPF = $modelUsuario->selectMax('cpf')->get()->getRow()->cpf;
       
        //for ($i = $maiorCPF; $i < $qtdeUsuarios; $i++) { 
        for ($i = 11; $i < $qtdeUsuarios+10; $i++) { 
            $nome = RandomUserHelper::geraNome();
            $tipoSanguineo = RandomUserHelper::geraTipoSanguineo();
            $fatorRh = RandomUserHelper::geraFatorRh();
            $email = strtolower(str_replace(' ', '.', $nome))."@gatomail.com";
            $sexo = preg_match('/[aezs]$/i', explode(' ', $nome)[0]) ? 'F' : 'M';
            $endereco = RandomUserHelper::geraEndereco();
            $telefone = RandomUserHelper::geraTelefone();
            $dataNascimento = RandomUserHelper::geraDataNascimento();


            $cpf_numbers = str_repeat($i+1, 11);
            $cpf_numbers = substr($cpf_numbers,0, 11);

            
            $dadosUsuario[] = [
                'cpf'  => $cpf_numbers,
                'nome_completo'  => $nome,
                'data_nascimento'  => $dataNascimento, 
                'endereco'  => $endereco,
                'municipio'  => "Marília",
                'telefone'  => $telefone,
                'email'  => $email, 
                'e_doador' => "S", 
                'tipo_sanguineo'  => $tipoSanguineo, 
                'fator_rh'  => $fatorRh, 
                'sexo'  => $sexo, 
                'data_ultima_doacao'  => null, 
                'senha'  => "\$2y\$10\$PbNMnqZosc3gSFOuItcX5uZ.SNq7qWP5X84S7LrtRZaZWOHl8Vni.", 
                'status' => ($i == 32) ? "99" : "1" 
            ];
        }

        //var_dump($dadosUsuario);
        //die();
        
        $modelUsuario->insertBatch($dadosUsuario); 
        

        //****************************************************** */
        // Inserir locais
        //****************************************************** */
        $data = [
            [
                'nome_local' => "Inserção manual",
                'endereco_local' => "Inserção manual",
                'municipio' => "Inserção manual",
                'descricao' => "O usuário inseriu manualmente uma doação"
            ],
            [
                'nome_local' => "Hemocentro de Marília",
                'endereco_local' => "Rua das Orquídeas, 200",
                'municipio' => "Marilia",
                'descricao' => "Horário de funcionamento: Seg a Sex das 07h00 às 13h00"
            ],
            [
                'nome_local' => "Hemocentro de Ourinhos",
                'endereco_local' => "Rua Expedicionários, 1000",
                'municipio' => "Ourinhos",
                'descricao' => "Atendimento 24h"
                ]            
            ];
      
        // ******************************************************
        $modelLocais->insertBatch($data);

        
        $totalLocais = $modelLocais->countAll();
        $totalUsuarios = $modelUsuario->countAll();

        //****************************************************** */
        # Inserindo 01 Solicitação (inserção manual)
        //****************************************************** */

        /*
        $data = [
            [
                'id_solicitacao' => 1,
                'id_usuario' => 1,
                'tipo_sanguineo' => "*",
                'fator_rh' => "*",
                'data_solicitação' => '01/01/1990',
                'cpf_receptor' => "O usuário inseriu manualmente uma doação"
            ]
            ];
      
        // ******************************************************
        $modelLocais->insertBatch($data);
        */


       
       //****************************************************** */
        # Inserindo doações realizadas
        //****************************************************** */
       $dadosDoacao = [];

       if ($qtdeDoacao != 0 ){
            $datasGeradas = RandomUserHelper::geraDatasAletorias($qtdeDoacao);
            
            for ($i = 0; $i < $qtdeDoacao; $i++) { 

                    $dadosDoacao[] = [
                        'id_usuario' => rand(1, $totalUsuarios),
                        'id_local' => rand(1, $totalLocais),
                        'data_solicitacao' => $datasGeradas[$i],
                        'data_doacao'  => null,
                        'status' => 1
                    ];      
                }       
            
                //************************************************************
                $modelDoacao->insertBatch($dadosDoacao);   
        }
        
        # Habilitando os relacionamentos das tabelas
        $modelDoacao->db->query('SET FOREIGN_KEY_CHECKS = 1;');
        $modelLocais->db->query('SET FOREIGN_KEY_CHECKS = 1;');
        $modelUsuario->db->query('SET FOREIGN_KEY_CHECKS = 1;');        
        $modelSolicitacao->db->query('SET FOREIGN_KEY_CHECKS = 1;');        

        return redirect()->to('/home');
       
    }

    public function doacao_confirmar($id_doacao_parametro){
        
        
        $modelDoacao = new DoacaoModel();
        //$id_doacao = explode(";",base64_decode(urldecode($id_doacao_parametro)))[0];


        if (strpos(base64_decode(urldecode($id_doacao_parametro)), ';') !== false) {
           $id_doacao =  explode(";",base64_decode(urldecode($id_doacao_parametro)))[0];
        }
        else {
            echo "Ocorreu um erro!";
            die();
        }        

        $data_atual = date('Y-m-d'); 
        $dados_para_atualizar = [
            'status' => 2,
            'data_doacao' => $data_atual
        ];
        $modelDoacao->update($id_doacao, $dados_para_atualizar);

        if ($modelDoacao->errors()) {
            echo $modelDoacao->errors();
            die();
        }

        /*
        $modelDoacao = new DoacaoModel();
        $id_doacao =  base64_decode( urldecode( $id_doacao_parametro ) );
        $modelDoacao->update($id_doacao, ['status' => 2]);
        if ($modelDoacao->errors()) {
          echo $modelDoacao->errors();
          die();
        } 
        */
        return redirect()->to('/home');

    }


    public function doacao_rejeitar($id_doacao_parametro){
        
        $modelDoacao = new DoacaoModel();

        if (strpos(base64_decode(urldecode($id_doacao_parametro)), ';') !== false) {
           $id_doacao =  explode(";",base64_decode(urldecode($id_doacao_parametro)))[0];
        }
        else {
            echo "Ocorreu um erro!";
            die();
        }

        $data_atual = date('Y-m-d'); 
        $modelDoacao->update(
            $id_doacao, [
                'status' => 3,
                'data_doacao' => $data_atual
            ]);

        if ($modelDoacao->errors()) {
          echo $modelDoacao->errors();
          die();
        } 
        return redirect()->to('/home');

    }

    public function limpacookie(){

        $cookie = $this->request->getCookie('emailteste');
        if ($cookie !== null) {
            $cookie_name = 'emailteste';
            $cookie_value = '';
            $expire_time = time() - 3600;
            setcookie($cookie_name, $cookie_value, $expire_time, '/');
        }
        return redirect()->to('/home');
        
    }
    


}
