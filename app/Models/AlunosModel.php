<?php

namespace App\Models;

use CodeIgniter\Model;

class AlunosModel extends Model
{
    protected $table            = 'alunos';
    protected $primaryKey       = 'id_aluno';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_aluno','nome','email','telefone','data_nascimento','data_cadastro','status'
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


    public function dados()
    {

        $sql = "SELECT alunos.*, 
        CONCAT('RA', LPAD(id_aluno, 4, '0')) AS id_aluno_formatado
        FROM alunos
        WHERE status='ativo'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function dados_pelo_id($id_aluno)
    {

        $sql = "SELECT alunos.*, 
        CONCAT('T', LPAD(id_aluno, 4, '0')) AS id_aluno_formatado
        FROM alunos
        WHERE status='ativo' AND id_aluno=$id_aluno";
        $query = $this->db->query($sql);
        //return $query->getResult();
        return $query->getRow();
        
        //return $this->findAll();
    }    
    
}
