<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Locais_doacao extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_local'=> [
                'type'=> 'INT',
                'auto_increment' => true,
                'null' => false
            ],

            'nome_local'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            
            'endereco_local'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'municipio'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'descricao'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],            

            'status'=> [
                'type'=> 'TINYINT',
                'null' => false,
                'default' => 1
            ],            
        ]);

        # Adicionando a chave primária (PK)
        $this->forge->addKey('id_local', true);


        # Adicionando a chave extrangeira (FK)
        #$this->forge->addForeignKey('id_usuario','usuarios','id_usuario');
        
        $this->forge->addForeignKey('id_local','doacao','id_local');

        # Criando a tabela Usuarios
        $this->forge->createTable('locais_doacao');
    }

    public function down()
    {
        $this->forge->dropTable('locais_doacao');
    }
}
