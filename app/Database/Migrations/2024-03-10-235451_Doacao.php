<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Doacao extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_doacao'=> [
                'type'=> 'INT',
                'auto_increment' => true,
                'null' => false

            ],

            'id_usuario'=> [
                'type'=> 'INT',
                'null' => false
            ],            

            'id_local'=> [
                'type'=> 'INT',
                'null' => false
            ],  

            'id_solicitacao'=> [
                'type'=> 'INT',
                'null' => false
            ],              

            'data_solicitacao'=> [
                'type'=> 'DATETIME',
                'null' => true
            ],            

            'data_doacao'=> [
                'type'=> 'DATETIME',
                'null' => true
            ],


            'status'=> [
                'type'=> 'TINYINT',
                'null' => false,
                'default' => 1
            ],            
        ]);

        # Adicionando a chave primária (PK)
        $this->forge->addKey('id_doacao', true);

        # Adicionando um índice secundário para id_local
        $this->forge->addKey('id_local');

        # Adicionando a chave extrangeira (FK)
        $this->forge->addForeignKey('id_usuario','usuarios','id_usuario');


        # Criando a tabela Usuarios
        $this->forge->createTable('doacao');
    }

    public function down()
    {
        $this->forge->dropTable('doacao');
    }
}
