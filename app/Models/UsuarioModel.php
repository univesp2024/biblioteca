<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id_usuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_usuario',
        'cpf',
        'nome_completo',
        'data_nascimento',
        'endereco',
        'municipio',
        'telefone',
        'email',
        'e_doador',
        'tipo_sanguineo',
        'fator_rh',
        'sexo',
        'data_ultima_doacao',
        'senha',
        'status'
    ];

    
    public function getByUserId($id_usuario)
    {
        return $this->where('id_usuario', $id_usuario)->first();
    }

    public function selecionaDoadores($tipoSangue, $fatorRh, $qtde)
    {
        // Tipo sanguíneo e seus respectivos receptores
        $doadores = array(
            'A+'  => array('A+','A-','O+','O-'),
            'A-'  => array('A-','O-'),
            'B+'  => array('B+','B-','O+','O-'),
            'B-'  => array('B-','O-'),
            'AB+' => array('A+','A-','B+','B-','AB+','AB-','O+','O-'),
            'AB-' => array('A-','B-','AB-','O-'),
            'O+'  => array('O+','O-'),
            'O-'  => array('O-')
        );


        $currentDate = date('Y-m-d');
        $condicaoSangue = implode('","', $doadores[$tipoSangue.$fatorRh]);

        
        $query = 'SELECT d_max.id_doacao,
                    u.id_usuario,
                    u.cpf,
                    u.nome_completo,
                    u.sexo,
                    u.tipo_sanguineo,
                    u.fator_rh,
                    u.email,
                    d.id_local,
                    d.id_solicitacao,
                    d.data_solicitacao,
                    d.data_doacao,
                    d.status
            FROM usuarios u
            LEFT JOIN (
                SELECT id_usuario, MAX(id_doacao) AS id_doacao
                FROM doacao
                GROUP BY id_usuario
            ) d_max ON u.id_usuario = d_max.id_usuario
            LEFT JOIN doacao d ON d_max.id_doacao = d.id_doacao
            WHERE CONCAT(u.tipo_sanguineo, u.fator_rh) IN ("'.$condicaoSangue.'")
            AND (d_max.id_doacao IS NULL OR (d.status IN (2, 3) AND
              (u.sexo = "F" AND d.data_doacao < DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) OR
              (u.sexo = "M" AND d.data_doacao < DATE_SUB(CURDATE(), INTERVAL 2 MONTH))))
            LIMIT '.$qtde;

        $lista = $this->db->query($query)->getResultArray();

        return $lista;


    

    }
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
}
