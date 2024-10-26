<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class EmprestimosModel extends Model
{
    protected $table            = 'emprestimos';
    protected $primaryKey       = 'id_emprestimo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_aluno', 'id_livro', 'data_emprestimo', 'data_devolucao', 'status'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function contarEmprestados()
    {
        //return $this->countAll()->where('status','pendente');
        return $this->where('status', 'pendente')->countAllResults();

    }

    public function registra_emprestimo()
    {
        $this->countAll();
    }    

    public function insere_emprestimo($id_livro, $id_aluno): void
    {
                $dataEmprestimo = Time::now();  // Data atual
        
                $data = [
                    'id_aluno' => $id_aluno,
                    'id_livro' => $id_livro,
                    'data_emprestimo' => $dataEmprestimo->toDateTimeString(),
                    'status' => 'pendente'
                ];

                $this->insert($data);
    }

    public function pega_dados()
    {
        
        $sql = "SELECT emprestimos.*, livros.titulo, livros.autor, alunos.*
                FROM emprestimos as emprestimos
                INNER JOIN livros as livros ON livros.id_livro = emprestimos.id_livro
                INNER JOIN alunos as alunos ON alunos.id_aluno = emprestimos.id_aluno
                WHERE emprestimos.status = 'pendente'
                ";

        $query = $this->db->query($sql);
        return $query->getResult();

    }

    public function atualiza_emprestimo($id_aluno, $id_livro): bool
    {
        $builder = $this->db->table('emprestimos');
        $builder->where('id_aluno', $id_aluno);
        $builder->where('id_livro', $id_livro);
        
        $data = ['status' => 'devolvido', 'data_devolucao' => date('Y-m-d H:i:s')];
    
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    

    
}
