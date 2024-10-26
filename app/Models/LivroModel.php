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
        'data_cadastro'
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
        return $this->findAll();
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



}
