<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class DoacaoModel extends Model
{
    protected $table            = 'doacao';
    protected $primaryKey       = 'id_doacao';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_doacao',
        'id_usuario',
        "id_local",
        "id_solicitacao",
        'data_solicitacao',
        'data_doacao',
        'status'
    ];


    public function getByUserId($id_usuario)
    {

        return $this->
           select('doacao.*,
                   solicitacao.nome_receptor,
                   locais_doacao.nome_local,
                   locais_doacao.endereco_local,
                   locais_doacao.municipio
            ')
            ->join(
                'locais_doacao',
                'doacao.id_local = locais_doacao.id_local
            ')
            ->join(
                'solicitacao',
                'doacao.id_solicitacao = solicitacao.id_solicitacao
            ')
            ->where('doacao.id_usuario', $id_usuario)
            ->orderBy('doacao.data_solicitacao', 'DESC')
            ->findAll();
/*
        return $this->select('doacao.*, locais_doacao.nome_local, locais_doacao.endereco_local, locais_doacao.municipio')
            ->join('locais_doacao', 'doacao.id_local = locais_doacao.id_local')
            ->where('doacao.id_usuario', $id_usuario)
            ->orderBy('doacao.data_solicitacao', 'DESC')
            ->findAll();
*/            
        
        /*    
        return $this->where('id_usuario', $id_usuario)
                    ->orderBy('data_doacao', 'DESC')
                    ->findAll();
        */ 
    }

    public function contaStatus($id_solicitacao) {
        
        return $this->select('status, COUNT(*) as total')
        ->where('id_solicitacao', $id_solicitacao)
        ->groupBy('status')
        ->findAll();

    }    

    public function qtdeDoacaoRealizada($id_usuario) {
        $resultado = $this->select('COUNT(*) as total')
        ->where('id_usuario', $id_usuario)
        ->where('status',2)
        ->findAll();
        return $resultado[0]['total'];
    }   
    
    
    public function qtdeTotalDoado() {
        $resultado = $this->select('COUNT(*) as total')
                          ->where('status', 2)
                          ->findAll();
        $total = $resultado[0]['total'];
        if ($total >= 1000) {
            $total = floor($total / 1000);
            $total .= 'k';
        }
        return $total;
    }
        
    public function qtdeTotalDoado_OLD() {
        $resultado = $this->select('COUNT(*) as total')
        ->where('status',2)
        ->findAll();
        return $resultado[0]['total'];
    }     


    public function ultimaDoacao($id_usuario) {
        $resultado = $this->select('MAX(data_doacao) as data_recente')
        ->where('id_usuario', $id_usuario)
        ->where('status',2)
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
