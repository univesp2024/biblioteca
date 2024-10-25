<?php

namespace App\Helpers;

class emailHelper
{

    public static function enviar($para, $assunto, $mensagem)
    {
        $email = \Config\Services::email();

        $email->setTo($para);
        $email->setFrom(config('Email')->fromEmail, config('Email')->fromName);
        $email->setSubject($assunto);
        $email->setMessage($mensagem);

        if ($email->send()) {
            return true;
            echo "Sucesso";
        } else {
            echo $email->printDebugger(['headers']);
            return false;
        }
    }

}