<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Solicitacao extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_solicitacao'=> [
                'type'=> 'INT',
                'auto_increment' => true,
                'null' => false
            ],

            'id_usuario'=> [
                'type'=> 'INT',
                'null' => false
            ],            

            'tipo_sanguineo'=> [
                'type'=> 'VARCHAR',
                'constraint' => 3,
                'null' => false
            ],
            
            'fator_rh'=> [
                'type'=> 'VARCHAR',
                'constraint' => 3,
                'null' => false
            ],

            'data_solicitacao'=> [
                'type'=> 'DATETIME',
                'null' => false
            ],

            'cpf_receptor'=> [
                'type'=> 'BIGINT',
                'null' => false
            ],

            'nome_receptor'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'id_local_doacao'=> [
                'type'=> 'INT',
                'null' => false
            ],

            'status'=> [
                'type'=> 'TINYINT',
                'null' => false,
                'default' => 1
            ],            
        ]);

        # Adicionando a chave primária (PK)
        $this->forge->addKey('id_solicitacao', true);

        # Adicionando a chave extrangeira (FK)
        $this->forge->addForeignKey('id_usuario','usuarios','id_usuario');

        # Criando a tabela Usuarios
        $this->forge->createTable('solicitacao');
    }

    public function down()
    {
        $this->forge->dropTable('solicitacao');
    }
}
