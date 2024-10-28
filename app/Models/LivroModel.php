<?php

namespace App\Models;

use CodeIgniter\Model;

class LivroModel extends Model
{
    protected $table            = 'livros';
    protected $primaryKey       = 'id_livro';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_livro',
        'titulo',
        'autor',
        'genero',
        'ano_publicacao',
        'quantidade_disponivel',
        'total_livros',
        'estante',
        'prateleira',
        'data_cadastro',
        'status'
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


    public function contarLivros()
    {
        return $this->selectSum('quantidade_disponivel')->get()->getRow()->quantidade_disponivel;
    }

    public function somaQuantidadeDisponivel()
    {
        return $this->selectSum('quantidade_disponivel')->get()->getRow()->quantidade_disponivel;
    }

    public function dados()
    {

        $sql = "SELECT livros.*, 
                CONCAT('T', LPAD(id_livro, 4, '0')) AS id_livro_formatado
                FROM livros
                WHERE status='ativo'";
        $query = $this->db->query($sql);
        return $query->getResult();
        //return $query->getResult();

        //CONCAT('RA', LPAD(alunos.id_aluno, 4, '0')) AS id_aluno_formatado, alunos.*, 
        //CONCAT('T', LPAD(livros.id_livro, 4, '0')) AS id_livro_formatado
        //return $this->findAll();
    }

    public function dados_by_id($id_livro)
    {
       return $this->where('id_livro', $id_livro)->first();
    }

    public function subtrairQuantidade($id_Livro)
    {
        $livroModel = new LivroModel();

        //$livro = $livroModel->find($id_Livro);
        $livro = $livroModel->where('id_livro', $id_Livro)->first();

        
        if ($livro && $livro['quantidade_disponivel'] > 0) {
            $livroModel->update($id_Livro, [
                'quantidade_disponivel' => $livro['quantidade_disponivel'] - 1
            ]);
            return redirect()->to('/home')->with('success', 'Quantidade atualizada com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Não há quantidade disponível para este livro.');
        }
    }    


    public function atualiza_qtde($id_livro): bool
    {
        $builder = $this->db->table('livros');
        $builder->where('id_livro', $id_livro);
        
        $data = ['quantidade_disponivel' => '1'];
    
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function next_idlivro(){

        $query = $this->db->query("SHOW TABLE STATUS LIKE 'livros'");
        $result = $query->getRowArray();

        return 'T' . str_pad($result['Auto_increment'], 4, '0', STR_PAD_LEFT);

    }


    public function livro_dados_pelo_id($id_livro)
    {

        $sql = "SELECT livros.*, 
        CONCAT('T', LPAD(id_livro, 4, '0')) AS id_livro_formatado
        FROM livros
        WHERE status='ativo' AND id_livro=$id_livro";
        $query = $this->db->query($sql);
        //return $query->getResult();
        return $query->getRow();
        
        //return $this->findAll();
    }  


  



}
