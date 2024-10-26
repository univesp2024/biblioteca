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
        return $this->countAll();
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

    
}
