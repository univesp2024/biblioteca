<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario'=> [
                'type'=> 'INT',
                'auto_increment' => true,
                'null' => false

            ],

            'cpf'=> [
                'type'=> 'BIGINT',
                'null' => false
            ],

            'nome_completo'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'data_nascimento'=> [
                'type'=> 'DATE',
                'null' => false
            ],

            'endereco'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'municipio'=> [
                'type'=> 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],

            'telefone'=> [
                'type'=> 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],

            'email'=> [
                'type'=> 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],            

            'e_doador'=> [
                'type'=> 'VARCHAR',
                'constraint' => 2,
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

            'sexo'=> [
                'type'=> 'VARCHAR',
                'constraint' => 1,
                'null' => false
            ],            

            'data_ultima_doacao'=> [
                'type'=> 'DATETIME',
                'null' => true
            ],

            'senha'=> [
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
        $this->forge->addKey('id_usuario', true);

        # Criando a tabela Usuarios
        $this->forge->createTable('usuarios');

    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
