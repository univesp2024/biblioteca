<?php

namespace App\Helpers;

class RandomUserHelper
{
    public static function geraNome()
    {
        /*
        $firstNames = [
            'Carlo', 'Ana', 'Jose', 'Mariana', 'Fernando', 'Aline', 'Rafael', 'Juliana', 'Luiz', 'Patricia',
            'Marco', 'Camila', 'Antonio', 'Isabela', 'Ricardo', 'Carolina', 'Paulo', 'Leticia', 'Pedro', 'Laura',
            'Roberto', 'Beatriz', 'Marcelo', 'Daniela', 'Bruno', 'Amanda', 'Daniel', 'Natalia', 'Fabiano', 'Thais',
            'Rodrigo', 'Larissa', 'Gustavo', 'Bianca', 'Viniciu', 'Jessica', 'Leandro', 'Vanessa', 'Eduardo', 'Gabriela', 'Diego', 'Cristina', 'Sergio', 'Tatiane', 'Alexandre', 'Fernanda', 'Pedro', 'Priscila', 'Murilo', 'Renata'
        ];
        */

        $firstNames = [
            'Carlo', 'Alessandro', 'Fernando', 'Rafaelo', 'Luizao', 'Marco', 'Antonio', 'Ricardo', 'Paulo', 'Pedro', 'Roberto', 'Marcelo', 'Bruno', 'Danilo', 'Fabiano', 'Rodrigo', 'Gustavo', 'Vinicio', 'Leandro', 'Eduardo', 'Diego', 'Sergio', 'Carlinho', 'Pedro', 'Murilo', 
            
            'Ana', 'Mariana', 'Aline', 'Juliana', 'Patricia', 'Camila', 'Isabela', 'Carolina', 'Leticia', 'Laura', 'Beatriz', 'Daniela', 'Amanda', 'Natalia', 'Thais', 'Larissa', 'Bianca', 'Jessica', 'Vanessa', 'Gabriela', 'Cristina', 'Tatiane', 'Fernanda', 'Priscila', 'Renata'
        ];
        
        
        $lastNames = [
            'Silva', 'Santos', 'Oliveira', 'Pereira', 'Ferreira', 'Almeida', 'Costa', 'Rodrigues', 'Martins', 'Souza', 'Araújo', 'Lima', 'Gomes', 'Melo', 'Barbosa', 'Cardoso', 'Correia', 'Nascimento', 'Cavalcante', 'Ribeiro', 'Freitas', 'Carvalho', 'Mendes', 'Dias', 'Castro', 'Mendes', 'Fortes', 'Pereira', 'Fonseca', 'Morais', 'Azevedo', 'Borges', 'Pacheco', 'Campos', 'Mota', 'Monteiro', 'Farias', 'Dantas', 'Nunes', 'Dantas', 'Sales', 'Lopes', 'Correa', 'Machado', 'Barros', 'Sousa', 'Moreira', 'Teixeira', 'Cruz', 'Vieira'
        ];
        
        

        $firstName = $firstNames[array_rand($firstNames)];
        $lastName = $lastNames[array_rand($lastNames)];

        return $firstName . ' ' . $lastName;
    }

    public static function geraTipoSanguineo()
    {
        $tipoSanguineo = [
            'A', 'B', 'AB', 'O'
        ];
        
        $tipoSanguineo = $tipoSanguineo[array_rand($tipoSanguineo)];

        return $tipoSanguineo;
    }

    public static function geraFatorRh()
    {
        $fatorRh = [
            '+', '-'
        ];
        
        $fatorRh = $fatorRh[array_rand($fatorRh)];

        return $fatorRh;
    }


    public static function geraEndereco()
    {
        $tiposLogradouro = ['Rua', 'Avenida', 'Travessa', 'Alameda', 'Estrada', 'Praça', 'Rodovia', 'Boulevard', 'Largo'];

        $nomesRuas = [
            'São João', 'Das Flores', 'Dos Ipês', 'Do Sol', 'Do Bosque', 'Da Paz', 'Do Lago', 'Das Palmeiras', 'Do Campo', 'Das Acácias',
            'Das Oliveiras', 'Do Cruzeiro', 'Da Esperança', 'Do Céu', 'Da Liberdade', 'Dos Girassóis', 'Dos Jasmins', 'Dos Cravos', 'Do Vale', 'Do Mar'
        ];
        
        $sobrenomes = [
            'Silva', 'Santos', 'Oliveira', 'Pereira', 'Ferreira', 'Almeida', 'Costa', 'Rodrigues', 'Martins', 'Souza',
            'Araújo', 'Lima', 'Gomes', 'Melo', 'Barbosa', 'Cardoso', 'Correia', 'Nascimento', 'Cavalcante', 'Ribeiro'
        ];
        
        $termosAdicionais = ['Nova', 'Velha', 'Grande', 'Pequena', 'Central', 'Sul', 'Norte', 'Leste', 'Oeste', 'Verde'];

        return $tiposLogradouro[array_rand($tiposLogradouro)] . ' ' . 
           $nomesRuas[array_rand($nomesRuas)] . ' ' . 
           $termosAdicionais[array_rand($termosAdicionais)]. ',  '.
           rand(1, 1000);

    }


    public static function geraTelefone()
    {
        $ddd = '14'; 
        $primeirosDigitos = rand(1000, 9999);
        $ultimosDigitos = rand(1000, 9999);
        
        return "($ddd) 9$primeirosDigitos-$ultimosDigitos";
    }

    public static function geraDataNascimento(){
        $timestampMin = strtotime('-18 years');
        $timestampMax = strtotime('-60 years');
        $timestampNascimento = rand($timestampMax, $timestampMin);
        
        return date('Y-m-d', $timestampNascimento);
    }

    public static function geraDatasAletorias($numero){
       // Gerada datas aleatórias
       $timestampMax = time();
       $timestampMin = strtotime('-1 year', $timestampMax);
       $tamanhoIntervalo = ($timestampMax - $timestampMin) / $numero;
       for ($i = 0; $i < $numero; $i++) { 
           $intervaloMin = $timestampMin + $i * $tamanhoIntervalo;
           $intervaloMax = $intervaloMin + $tamanhoIntervalo;
           $timestamp = rand($intervaloMin, $intervaloMax);
           $dataFormatada = date('Y-m-d H:i:s', $timestamp);
           $datasGeradas[] = $dataFormatada;
       }
       return $datasGeradas;
    }



    
}
