<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class SolicitacaoModel extends Model
{
    protected $table            = 'solicitacao';
    protected $primaryKey       = 'id_solicitacao';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_solicitacao',
        'id_usuario',
        'tipo_sanguineo',
        'fator_rh',
        'data_solicitacao',
        'cpf_receptor',
        'nome_receptor',
        'id_local_doacao',
        'status'
    ];

    public function getByUserId($id_usuario)
    {
        return $this->select('*')
            ->join('locais_doacao', 'solicitacao.id_local_doacao = locais_doacao.id_local')
            ->where('solicitacao.id_usuario', $id_usuario)
            ->orderBy('solicitacao.data_solicitacao', 'DESC')
            ->findAll();
    }

    
    public function qtdeSolicitacaoRealizada($id_usuario) {
        $resultado = $this->select('COUNT(*) as total')
        ->where('id_usuario', $id_usuario)
        ->findAll();
        return $resultado[0]['total'];
    }      

    public function contaStatus($id_solicitacao)
    {
        return $this->select('status, COUNT(*) as total')
        ->where('id_solicitacao', $id_solicitacao)
        ->groupBy('status')
        ->findAll();
    }

    public function getCPFreceptor($cpfReceptor)
    {
        return $this->select('*')
            ->where('solicitacao.cpf_receptor', $cpfReceptor)
            ->orderBy('solicitacao.data_solicitacao', 'DESC')
            ->findAll();

    }


    public function ultimaSolicitacao($id_usuario) {
        $resultado = $this->select('MAX(data_solicitacao) as data_recente')
        ->where('id_usuario', $id_usuario)
        ->first();

        $dataRecente = new DateTime($resultado['data_recente']);
        $dataFormatada = $dataRecente->format('d/m/y');
        return $dataFormatada;
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
