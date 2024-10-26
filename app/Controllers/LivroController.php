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
            'environment' => ENVIRONMENT
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
            'dados' => $dados
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
            'environment' => ENVIRONMENT
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
            'environment' => ENVIRONMENT
        ]);
        echo view('Livro/FinalizaEmprestimoView', [
            'environment' => ENVIRONMENT,
            'id_livro' => $id_livro,
            'dados' => $dados_livro,
            'dados_alunos' => $dados_alunos
        ]);
        echo view("usuario/template/FooterView");
    }   
    
    public function registra_emprestimo($id_livro,$id_aluno): mixed
    {
        
        $emprestimoModel = new EmprestimosModel();
        $livroModel = new LivroModel();
        
        echo $id_aluno = base64_decode($id_aluno)/45687986546;
        echo "<br>";
        echo $id_livro = base64_decode($id_livro)/43467323246;

        $emprestimoModel -> insere_emprestimo($id_livro, $id_aluno);
        
        $livroModel -> subtrairQuantidade($id_livro);

        //return redirect()->to('/home');
        return redirect()->to('/home')->with('success', 'Empréstimo finalizado com sucesso!');
    }


    public function aluno_devolver($id_livro,$id_aluno): mixed
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
        return redirect()->to('/home')->with('success', 'Livro restituído com sucesso!');

    }



}
