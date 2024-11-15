<?php

namespace App\Controllers;
use App\Models\EmprestimosModel;
use App\Models\LivroModel;
use App\Models\AlunosModel;
use CodeIgniter\HTTP\RedirectResponse;

class LivroController extends BaseController
{

    public function emprestar_livro()
    {

        $livroModel = new LivroModel();
        $dados = $livroModel->dados();
        

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'rotaAtual' => uri_string()
        ]);
        echo view('Livro/EmprestarView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);
        echo view("usuario/template/FooterView");
    }    



    public function devolver_livro()
    {

        $emprestimoModel = new EmprestimosModel();
        $dados = $emprestimoModel->pega_dados();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'dados' => $dados,
            'rotaAtual' => uri_string()
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
            'environment' => ENVIRONMENT,
            'rotaAtual' => uri_string()
        ]);
        echo view('Livro/ConsultarView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);
        echo view("usuario/template/FooterView");
    }      
    
    
    public function finaliza_emprestimo($id_livro)
    {

        $id_livro = base64_decode($id_livro)/44787654548;


        $livroModel = new LivroModel();
        $alunoModel = new AlunosModel();

        $dados_livro = $livroModel->dados_by_id($id_livro);
        $dados_alunos = $alunoModel->dados();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'rotaAtual' => uri_string()
        ]);
        echo view('Livro/FinalizaEmprestimoView', [
            'environment' => ENVIRONMENT,
            'id_livro' => $id_livro,
            'dados' => $dados_livro,
            'dados_alunos' => $dados_alunos
        ]);
        echo view("usuario/template/FooterView");
    }   
    
    public function registra_emprestimo($id_livro,$id_aluno) 
    {
        
        $emprestimoModel = new EmprestimosModel();
        $livroModel = new LivroModel();
        
        echo $id_aluno = base64_decode($id_aluno)/45687986546;
        echo "<br>";
        echo $id_livro = base64_decode($id_livro)/43467323246;

        $emprestimoModel -> insere_emprestimo($id_livro, $id_aluno);
        
        $livroModel -> subtrairQuantidade($id_livro);

       
        return redirect()->to(base_url('home'))->with('success', 'Empréstimo finalizado com sucesso!');
    }


    
    public function cadastrar_livro(): void
    {

        $livroModel = new LivroModel();
        $next_idlivro = $livroModel->next_idlivro();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'rotaAtual' => uri_string()
        ]);
        echo view('Livro/CadastroLivroView', [
            'environment' => ENVIRONMENT,
            'next_id_livro' => $next_idlivro
        ]);
        echo view("usuario/template/FooterView");
    }

    public function aluno_devolver($id_livro,$id_aluno) 
    {
        $id_livro = base64_decode($id_livro)/44787654548;
        $id_aluno = base64_decode($id_aluno)/54652154678;

       
        $emprestimoModel = new EmprestimosModel();
        $livroModel = new LivroModel();

        $resultado = $emprestimoModel->atualiza_emprestimo($id_aluno,$id_livro);

        $livroModel->atualiza_qtde($id_livro);
        
        //echo $id_aluno = base64_decode($id_aluno)/45687986546;
        //echo $id_livro = base64_decode($id_livro)/43467323246;
        //$emprestimoModel -> insere_emprestimo($id_livro, $id_aluno);
        //$livroModel -> subtrairQuantidade($id_livro);

        //return redirect()->to('/home');
        return redirect()->to(base_url('home'))->with('success', 'Livro restituído com sucesso!');

    }

    

    public function cadastrar_livro_post()
    {
        
        /*
        echo $id_livro = $this->request->getVar('id_livro');
        echo $titulo = $this->request->getVar('titulo');
        echo $autor = $this->request->getVar('autor');
        echo $genero = $this->request->getVar('genero');
        echo $ano_publicacao = $this->request->getVar('ano_publicacao');
        echo $estante = $this->request->getVar('estante');
        echo $prateleira = $this->request->getVar('prateleira');
        */

        $livroModel = new LivroModel();

        $data = [
            'titulo'         => $this->request->getVar('titulo'),
            'autor'          => $this->request->getVar('autor'),
            'genero'         => $this->request->getVar('genero'),
            'ano_publicacao' => $this->request->getVar('ano_publicacao'),
            'estante'        => $this->request->getVar('estante'),
            'prateleira'     => $this->request->getVar('prateleira'),
            'data_cadastro'  => date('Y-m-d H:i:s'),
            'quantidade_disponivel' => '1'
        ];


        if ($livroModel->insert($data)) {
            return redirect()->to('/home')->with('success', 'Livro cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar o livro.')->withInput();
        }




        //return redirect()->to('/home')->with('success', 'Livro cadastrado com sucesso!');



    }

    public function index()
    {

        $livroModel = new LivroModel();
        $dados = $livroModel->dados();
        //var_dump($dados);
        //die;




        echo view('publico/PublicoConsultarView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);

    }       

    
    public function gerencia_livro(){

        $livroModel = new LivroModel();
        $dados = $livroModel->dados();

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'rotaAtual' => uri_string()
        ]);
        echo view('Livro/GerenciaLivroView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);
        echo view("usuario/template/FooterView");
    }


    
    public function editar_livro($id_livro)
    {

        $id_livro = base64_decode($id_livro)/3329879632876;
        
        $livroModel = new LivroModel();
        $dados = $livroModel->livro_dados_pelo_id($id_livro);
        //var_dump($dados);
        //echo $dados->nome;
        //die;

        echo view("usuario/template/HeaderView");
        echo view("usuario/template/SidebarView", [
            'environment' => ENVIRONMENT,
            'rotaAtual' => uri_string()
        ]);
        echo view('Livro/EditarLivroView', [
            'environment' => ENVIRONMENT,
            'dados' => $dados
        ]);
        echo view("usuario/template/FooterView");

    }

    
    public function editar_livro_post()
    {

        $livroModel = new LivroModel();
        $id_livro = $this->request->getVar('id_livro');

        $data = [
            'titulo'          => $this->request->getVar('titulo'),
            'autor'           => $this->request->getVar('autor'),
            'genero'          => $this->request->getVar('genero'),
            'ano_publicacao'  => $this->request->getVar('ano_publicacao'),
            'estante'         => $this->request->getVar('estante'),
            'prateleira'      => $this->request->getVar('prateleira'),
        ];

        //var_dump($data);
        //die;

        if ($livroModel->update(['id_livro' => $id_livro], $data)) {
            return redirect()->to('/gerencia_livro')->with('success', 'Livro editado com sucesso!');
        } else {
            return redirect()->to('/gerencia_livro')->with('error', 'Erro ao editar o livro.');
        }

    }


    public function apaga_livro($id_livro)
    {

        $livroModel = new LivroModel();
        $emprestimosModel = new EmprestimosModel();

        $id_livro = base64_decode($id_livro) / 54655345764678;        

        $pode_apagar=$emprestimosModel->verifica_delete_livro($id_livro);

        if ($pode_apagar){
            $livro = $livroModel->where('id_livro', $id_livro)->first();
            if ($livro) {
                $data = ['status' => 'inativo'];
        
                $livroModel->set($data)->where('id_livro', $id_livro)->update();
        
                return redirect()->to('/gerencia_livro')->with('success', 'Livro apagado com sucesso!');
            } else {
                return redirect()->to('/gerencia_livro')->with('error', 'Livro não encontrado!');
            }
        }
        else {
            return redirect()->to('/gerencia_livro')->with('error', 'O livro possui pendência(s)<br>e não pode ser apagado!');
        }
    }       



}
