<?php

namespace ControllerPadrao;

//error_reporting(0);

//outras Exceptions
use Exception;

class ClassePadrao{
    public static function validaCamposObrigatorios($matrizDeDados) {
        $dadosInformados = Array();

        foreach ($matrizDeDados as $valoresForm => $dado) {
            //Se o dado for um array, significa que o campo é obrigatório,
            //então verifico se ele está preenchido, caso não esteja, faço um redirect
            if(is_array($dado) && ( is_null($dado['required']) || empty($dado['required']) ) )
                return false;

            else if( is_array($dado) && ( !is_null($dado['required']) || !empty($dado['required']) )  )
                $dadosInformados[$valoresForm] = $dado['required'];
            else
                $dadosInformados[$valoresForm] = $dado;
        }

        return $dadosInformados;

    }

    public static function validaCPF($cpf) {
        
    }
}

